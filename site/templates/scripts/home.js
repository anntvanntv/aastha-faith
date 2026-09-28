




document.addEventListener("DOMContentLoaded", () => {

// Hero slideshow — auto-rotate background slides every 3s
const heroSlides = document.querySelectorAll(".hero-slide");
if (heroSlides.length > 1) {
    let cur = 0;
    setInterval(() => {
        heroSlides[cur].classList.remove("active");
        cur = (cur + 1) % heroSlides.length;
        heroSlides[cur].classList.add("active");
    }, 3000);
}

const video = document.getElementById("myVideo");
const btn = document.querySelector(".play-btn");


    btn.addEventListener("click", () => {
        video.play();
        video.setAttribute("controls", "");
        btn.style.display = "none";
    });

// Clamp long card text to 6 lines with a Read more / Show less toggle.
// Works for every .clamp-wrap; the button only appears when text overflows.
document.querySelectorAll(".clamp-wrap").forEach((wrap) => {
    const p = wrap.querySelector(".clamp-text");
    const toggle = wrap.querySelector(".expand-text-btn");
    if (!p || !toggle) return;
    p.classList.add("clamped");
    if (p.scrollHeight > p.clientHeight + 4) {
        toggle.style.display = "inline-block";
    }
    toggle.addEventListener("click", () => {
        const nowClamped = p.classList.toggle("clamped");
        toggle.textContent = nowClamped ? "Read more" : "Show less";
        toggle.setAttribute("aria-expanded", String(!nowClamped));
    });
});
});



let section = document.getElementsByClassName('in-numbers');

console.log(section);



const links = document.querySelectorAll('.vertical-card-link');

links.forEach(link => {
    link.addEventListener('click', (e) => {
        if(link.querySelector('.pw-edit-attr')) {
          
            e.preventDefault();
            
        }
    })

})


/* logo carousel */

const track = document.querySelector('.carousel-track');
const prevButton = document.querySelector('.car-prev-ar');
const nextButton = document.querySelector('.car-next-ar');

prevButton.addEventListener('click', () => {
    track.scrollBy({
        left: -400,
        behavior: 'smooth'
    })
})

nextButton.addEventListener('click', () => {
    track.scrollBy({
        left: 400,
        behavior: 'smooth'
    })
})


/* impact stats — count-up on scroll into view */
const statNumbers = document.querySelectorAll("#stats .static-card h2");
if (statNumbers.length && "IntersectionObserver" in window) {
    const animateStat = (el) => {
        const raw = el.textContent.trim();
        const match = raw.match(/^([\d,]+)(.*)$/);
        if (!match) return;
        const target = parseInt(match[1].replace(/,/g, ""), 10);
        const suffix = match[2];
        const duration = 1600;
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased).toLocaleString("en-US") + suffix;
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    };
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateStat(entry.target);
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    statNumbers.forEach((el) => statObserver.observe(el));
}

// Coverage map — Nepal districts, hover tooltips with admin-managed metrics
(function () {
    var el = document.getElementById('coverage-map');
    if (!el || typeof L === 'undefined') return;

    var map = L.map(el, {
        zoomControl: false,
        attributionControl: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        dragging: false,
        touchZoom: false
    });

    var data = window.coverageDistricts || {};
    var esc = function (s) {
        var d = document.createElement('div');
        d.textContent = s;
        return d.innerHTML;
    };
    var label = function (name) {
        // Title-case only when the source name is ALL CAPS
        return name === name.toUpperCase() ? name.charAt(0) + name.slice(1).toLowerCase() : name;
    };
    var norm = function (s) { return String(s).toUpperCase().replace(/[^A-Z]/g, ''); };
    // dataset spellings / 2017 splits an admin-entered name should also match
    var ALIASES = {
        CHITWAN: ['CHITAWAN'],
        MAKWANPUR: ['MAKAWANPUR'],
        NAWALPARASI: ['NAWALPUR', 'PARASI'],
        NAWALPARASIEASTWEST: ['NAWALPUR', 'PARASI']
    };
    // normalized lookup: map-dataset district name -> metric
    var lookup = {};
    Object.keys(data).forEach(function (k) {
        (ALIASES[norm(k)] || [norm(k)]).forEach(function (t) { lookup[t] = data[k]; });
    });

    fetch(el.dataset.geojson)
        .then(function (r) { return r.json(); })
        .then(function (geo) {
            var layer = L.geoJSON(geo, {
                style: function (f) {
                    var active = !!lookup[norm(f.properties.DISTRICT)];
                    return {
                        color: active ? '#f2f1ee' : '#b3b3b3',
                        weight: active ? 1 : 0.7,
                        fillColor: active ? '#113f39' : '#f2f1ee',
                        fillOpacity: active ? 1 : 0.55
                    };
                },
                onEachFeature: function (feature, lyr) {
                    var name = feature.properties.DISTRICT || '';
                    var key = norm(name);
                    var metric = lookup[key];
                    var active = metric !== undefined;
                    var lines = metric ? String(metric).split(/\r?\n/).filter(function (l) { return l.trim(); }) : [];
                    var html = '<div class="map-tip"><strong>' + esc(label(name)) + '</strong>' +
                        lines.map(function (l) { return '<span>' + esc(l) + '</span>'; }).join('') + '</div>';
                    lyr.bindTooltip(html, {
                        sticky: true,
                        direction: 'top',
                        className: 'coverage-tooltip'
                    });
                    lyr.on('mouseover', function () {
                        if (active) lyr.setStyle({ fillColor: '#195e56', weight: 1.4, fillOpacity: 1 });
                    });
                    lyr.on('mouseout', function () { layer.resetStyle(lyr); });
                }
            }).addTo(map);
            map.fitBounds(layer.getBounds(), { padding: [14, 14] });

            // province borders — thick outline overlay, must not block district hover
            fetch(el.dataset.provinces)
                .then(function (r) { return r.json(); })
                .then(function (pgeo) {
                    // light halo under dark line — readable on both dark fills and light bg
                    L.geoJSON(pgeo, {
                        interactive: false,
                        style: { color: '#f2f1ee', weight: 4.5, fill: false, opacity: 1 }
                    }).addTo(map);
                    L.geoJSON(pgeo, {
                        interactive: false,
                        style: { color: '#343434', weight: 2, fill: false, opacity: 0.9 }
                    }).addTo(map);
                });
        });
})();
