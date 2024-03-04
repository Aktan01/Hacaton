const openInstructionModalBtn = document.querySelector('.header-btn')
const instructionModal = document.querySelector('#instruction-my__modal')
const closeInstructionModalBtn = document.querySelector('#close-instruction-btn')

const instruction = document.querySelector('.instruction')

openInstructionModalBtn.addEventListener('click', () => {
    instructionModal.classList.add('open')
})
closeInstructionModalBtn.addEventListener('click', () => {
    instructionModal.classList.remove('open')
})
window.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        instructionModal.classList.remove("open")
    }
});




const openOfferModalBtn = document.querySelector('.create-portfolio__btn')
const offerModal = document.querySelector('#offer-modal')
const closeOfferModalBtn = document.querySelector('#close-offer-btn')
const wrap = document.querySelector('body')

const offer = document.querySelector('.offer')

openOfferModalBtn.addEventListener('click', () => {
    offerModal.classList.add('open')
})
closeOfferModalBtn.addEventListener('click', () => {
    offerModal.classList.remove('open')
})
window.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        offerModal.classList.remove("open")
    }
});

document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#offer-date-before", {
        locale: "ru",
        maxDate: "15.12.2027",
    }); // Инициализация Flatpickr
});
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#offer-date-after", {
        locale: "ru",
        maxDate: "15.12.2027",
    }); // Инициализация Flatpickr
});

// ушул жерден баштап кошосун калганы ошол бойдон

const playButton = document.querySelector('#play-button')
const pauseButton = document.querySelector('#pause-button')
const stopButton = document.querySelector('#stop-button')
const textInput = document.querySelector('#text')
const speedInput = document.querySelector('#speed')
let currentCharacter

playButton.addEventListener('click', () => {
    playText(textInput.value)
})
pauseButton.addEventListener('click', pauseText)
stopButton.addEventListener('click', stopText)
speedInput.addEventListener('input', () => {
    stopText()
    playText(utterance.text.substring(currentCharacter))
})

const utterance = new SpeechSynthesisUtterance()
utterance.addEventListener('end', () => {
    textInput.disabled = false
})
utterance.addEventListener('boundary', e => {
    currentCharacter = e.charIndex
})

function playText(text) {
    if (speechSynthesis.paused && speechSynthesis.speaking) {
        return speechSynthesis.resume()
    }
    if (speechSynthesis.speaking) return
    utterance.text = text
    utterance.rate = speedInput.value || 1
    textInput.disabled = true
    speechSynthesis.speak(utterance)
}

function pauseText() {
    if (speechSynthesis.speaking) speechSynthesis.pause()
}

function stopText() {
    speechSynthesis.resume()
    speechSynthesis.cancel()
}

const openTextToSpeechBtn = document.querySelector('.btn-open-to__speech')
const textToSpeechModal = document.querySelector('#text-speech-my__modal')
const closeTextToSpeechlBtn = document.querySelector('#close-text-to-speech-btn')

const TextToSpeech = document.querySelector('.text-to-speech-modal')

openTextToSpeechBtn.addEventListener('click', () => {
    textToSpeechModal.classList.add('open')
})
closeTextToSpeechlBtn.addEventListener('click', () => {
    textToSpeechModal.classList.remove('open')
})
window.addEventListener('keydown', (e) => {
    if (e.key === "Escape") {
        textToSpeechModal.classList.remove("open")
    }
});