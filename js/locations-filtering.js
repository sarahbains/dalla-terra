const FILTERS = document.querySelectorAll('.location-filter');
const LOCATIONS = document.querySelectorAll('.location');

FILTERS?.forEach(filter => {
    filter.addEventListener('click', (e) => {
        let searchParams = new URLSearchParams(window.location.search);
        const filter = e.target.dataset.location;
        let newRelativePathQuery = null;

        if (searchParams.has('location')) {
            const location = JSON.parse(searchParams.get('location'));

            if (Array.isArray(location) && !location.includes(parseInt(filter))) {
                searchParams.set('location', [filter, ...location]);
                newRelativePathQuery = window.location.pathname + `?location=[${searchParams.get('location')}]`;

            } else if (Array.isArray(location) && location.includes(parseInt(filter))) {
                const index = location.indexOf(parseInt(filter));
                location.splice(index, 1);

                if (location.length) {
                    searchParams.set('location', location);
                    newRelativePathQuery = window.location.pathname + `?location=[${searchParams.get('location')}]`;
                } else {
                    newRelativePathQuery = window.location.pathname;
                }
            }

        } else {
            searchParams.set('location', [filter]);
            newRelativePathQuery = window.location.pathname + `?location=[${searchParams.get('location')}]`;
        }

        if (newRelativePathQuery) {
            history.pushState({}, '', newRelativePathQuery);
            filtering();
        }

        e.target.blur();
    });
})

let terms = [];
let locations = [];

const filtering  = async () => {

    window.WPLeafletMapPlugin.push(() => {
        let group = window.WPLeafletMapPlugin.getCurrentGroup();
        group._layers = [];
        document.querySelector('.leaflet-marker-pane').innerHTML = '';
        document.querySelector('.leaflet-shadow-pane').innerHTML = '';
    });

    let searchParams = new URLSearchParams(window.location.search);

    let param = ['all'];

    const setTerms = async () => {
        const fetchTerms = await fetch('https://dallaterra.bcitwebdeveloper.ca/wp-json/wp/v2/dt-location-category', {
            mode: 'cors'
        });

        const data = await fetchTerms.json();

        data.forEach(term => {
            terms.push(term.id);
        });
    }

    if (terms.length === 0) await setTerms();

    if (searchParams.has('location')) {

        const location = JSON.parse(searchParams.get('location'));

        if (Array.isArray(location) && location.every(id => terms.includes(id))) {
            param = location;
        }
    }

    const setLocations = async () => {
        const fecthLocations = await fetch('https://dallaterra.bcitwebdeveloper.ca/wp-json/wp/v2/dt-locations', {
            mode: 'cors'
        });

        const data = await fecthLocations.json();
        
        data.forEach(location => {
            locations.push({
                name: location.title.rendered,
                lng: location.acf.longitude,
                lat: location.acf.latitude,
                add: location.acf.address,
                locationTypes: location['dt-location-category']
            });
        });
    }

    if (locations.length === 0) await setLocations();

    LOCATIONS.forEach(location => {
        const locationData = JSON.parse(location.dataset.locations);

        if ((Array.isArray(locationData) && param.some(id => locationData.includes(id))) || param.includes('all')) {
            if (location.classList.contains('hide')) location.classList.remove('hide');
        } else if (!location.classList.contains('hide')) {
            location.classList.add('hide');
        }
    });

    FILTERS.forEach(filter => {
        const locationData = parseInt(filter.dataset.location);

        if (param.includes(locationData)) {
            filter.classList.add('toggled');
        } else if (filter.classList.contains('toggled')) {
            filter.classList.remove('toggled');
        }
    });

    locations.forEach(location => {
        if (param.includes('all') || param.some(id => location.locationTypes?.includes(id))) {
            window.WPLeafletMapPlugin = window.WPLeafletMapPlugin || [];
            window.WPLeafletMapPlugin.push(function WPLeafletMarkerShortcode() {
                
                let group = window.WPLeafletMapPlugin.getCurrentGroup();
                let marker_options = window.WPLeafletMapPlugin.getIconOptions({});
                let marker = L.marker(
                    [location.lat, location.lng],
                    marker_options
                );
                marker.addTo(group);
                marker.bindPopup(`${location.name} <br /> <br /> ${location.add}`); 
                window.WPLeafletMapPlugin.markers.push(marker);
            });
        }
    });
}

filtering();