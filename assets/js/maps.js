
const map = L.map('map', {
    center: [-23.5218, -46.4355], // Coordenadas iniciais
    zoom: 20,                    // Nível inicial de zoom
    minZoom: 18,                 // Nível mínimo de zoom
    maxZoom: 20,                  // Nível máximo de zoom
    edgeBufferTiles: 2
});

// Adicionando a camada de mapa (dark theme)
L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
    subdomains: 'abcd',
    minZoom: 18,
    maxZoom: 20
}).addTo(map);

// Criando o ícone personalizado
const customIcon = L.icon({
    iconUrl: '/assets/img/pin-icon.png',  // Caminho para a imagem do ícone
    iconSize: [50, 70],           // Tamanho do ícone
    iconAnchor: [3, 3],         // Posição do ponto de ancoragem do ícone
    popupAnchor: [22, -10],        // Posição do popup em relação ao ícone
});

// Criando o marcador com o ícone personalizado
const marker = L.marker([-23.5218, -46.4355], { icon: customIcon })
    .addTo(map)
    .bindPopup('<b>Sara Fashion</b><br>Zona Leste');

// Controlando a visibilidade do ícone do marcador baseado no zoom
function toggleMarkerVisibility() {
    const currentZoom = map.getZoom();
    const markerIcon = marker._icon;  // Obtendo o ícone do marcador

    if (currentZoom < 20) {
        markerIcon.classList.add('hidden');
    } else {
        markerIcon.classList.remove('hidden');
    }
}

// Escutando eventos de zoom no mapa
map.on('zoom', toggleMarkerVisibility);

// Inicializando a visibilidade do marcador
toggleMarkerVisibility();

// Exibindo o popup ao clicar no marcador
marker.on('click', () => {
    marker.openPopup();  // Abre o popup do marcador
});