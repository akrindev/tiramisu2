class Storage {
    constructor() {
        this.type = null
        this.starting_pot = 89
        this.final = null
        this.display = {}
        this.mats = []
        this.highest_step = 0
    }

    setDisplay(view) {
        this.display = view
    }

    setting(type, starting_pot) {
        this.type = type
        this.starting_pot = parseInt(starting_pot)
    }

    setMats(mats, max_step) {
        this.mats = mats
        this.highest_step = max_step
    }

    setFinal(result) {
        this.final = result
    }
}

const Cloud = new Storage();