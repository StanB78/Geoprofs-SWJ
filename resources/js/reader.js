class Reader {
    constructor(defaultLang = 'nl-NL', speed = 1, pitch = 1) {
        this.lang = defaultLang
        this.speed = speed
        this.pitch = pitch
        this.synth = window.speechSynthesis
        this.active = false
        this.utterance = null
        this.btn = document.getElementById('readBtn')
        this.langSelect = document.getElementById('langSelect')
        this.init()
    }

    init() {
        if (!this.btn || !this.langSelect) return

        this.btn.addEventListener('click', () => {
            this.active = !this.active
            this.btn.textContent = `Voorlezen: ${this.active ? 'Aan' : 'Uit'}`
            if (!this.active) this.stop()
        })

        this.langSelect.addEventListener('change', () => {
            this.lang = this.langSelect.value
        })

        document.addEventListener('mouseup', () => {
            if (!this.active) return
            const selectedText = window.getSelection().toString().trim()
            if (selectedText.length > 0) this.read(selectedText)
        })
    }

    read(text) {
        if (!text) return
        this.stop()
        this.utterance = new SpeechSynthesisUtterance(text)
        this.utterance.lang = this.lang
        this.utterance.rate = this.speed
        this.utterance.pitch = this.pitch
        this.synth.speak(this.utterance)
    }

    stop() {
        if (this.synth.speaking) this.synth.cancel()
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new Reader()
})
