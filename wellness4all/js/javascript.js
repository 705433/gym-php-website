//scroll progress bar
function scroll() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - window.innerHeight;
    var scrolled = (winScroll / height) * 100;
    document.getElementById("scroll").style.width = scrolled + "%";
}


//modals
function showLgModal(){ 
document.querySelector('.lg-modal').style.display = 'flex';
}
function hideLgModal(){ 
document.querySelector('.lg-modal').style.display = 'none';}

function showRgModal(){ 
document.querySelector('.rg-modal').style.display = 'flex';
}
function hideRgModal(){ 
document.querySelector('.rg-modal').style.display = 'none';}

//map
function initMap() {
    var uluru = {
        lat: 51.4019975,
        lng: -0.1841921
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: uluru
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}
