

class Storage {
    constructor() {
        this.type = null
        this.starting_pot = 89
        this.final = null
        this.display = {}
        this.mats = []
        this.max_step = 0
        this.success_rate = 0

        this.loading = ["btn-loading", "disabled"]
    }

    setDisplay(view) {
        this.display = view
    }

    setSuccessRate(rate) {
        this.success_rate = rate
    }

    setting(type, starting_pot) {
        this.type = type
        this.starting_pot = parseInt(starting_pot)
    }

    setMats(mats, max_step) {
        this.mats = mats
        this.max_step = max_step
    }

    setFinal(result) {
        this.final = result
    }

    getToken() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content")

        return token
    }

    getNote() {
        let note = document.getElementById("note").value

        return note
    }

    send() {
        let btn = document.getElementById("save")
        btn.classList.add(...this.loading)

        if(this.display !== null) {
            swal("Failed", "Kamu belum membuat perubahan", "error")

            btn.classList.remove(...this.loading)
            return
        }

        this.saveToCloud()
    }

    saveToCloud() {
        let btn = document.getElementById("save")
        axios({
        	method: 'POST',
            url: '/fill_stats/save',
            data: {
                "_token": this.getToken(),
                'type': this.type,
                "note": this.getNote(),
                "body": this.display,
                "final": this.final,
                "starting_pot": this.starting_pot,
                "mats": this.mats,
                "highest_mats": this.max_step,
                "success_rate": this.success_rate
            }
        }).then(res => {
        	if(res.data.success) {
                swal("Yeayy!!", "Formula saved", "success")
            }
        }).catch(e => alert(e))
        .finally((e) => {
        	btn.classList.remove(...this.loading)
        })
    }
}

const Cloud = new Storage();