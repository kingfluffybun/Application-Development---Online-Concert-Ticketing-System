const readyForLove = new Audio('/assets/sound/ReadyForLove.mp3');
const playButton = document.getElementById('play-btn');

let isPlaying = false;
playButton.addEventListener('click', () => {
    if(!isPlaying) {
        readyForLove.play();
        playButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pause-icon lucide-pause"><rect x="14" y="3" width="5" height="18" rx="1"/><rect x="5" y="3" width="5" height="18" rx="1"/></svg>';
        console.log('Now Playing: Ready For Love');
        isPlaying = true;
    } else {
        readyForLove.pause();
        playButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play-icon lucide-play"><path d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z"/></svg>';
        console.log('Music Stopped');
        isPlaying = false;
    }
})