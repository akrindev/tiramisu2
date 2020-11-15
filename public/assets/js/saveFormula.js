

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
        let recipe_pot = document.getElementById("recipe_pot").value
        let starting_pot = document.getElementById('starting_pot').value

        if(parseInt(recipe_pot) > 150 || parseInt(starting_pot) > 150) {
            swal("Failed", "Invalid pot", "error")

            return;
        }

        if(this.success_rate == 0) {
            swal("Error", "Success rate 0", "error")
            return;
        }

        btn.classList.add(...this.loading)

        if(this.max_step === 0) {
            swal("Failed", "Kamu belum membuat perubahan", "error")

            btn.classList.remove(...this.loading)
            return
        }

        this.saveToCloud()
    }

    saveToCloud() {
        let btn = document.getElementById("save")
        let text = document.getElementById("note")

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

            btn.hidden = true
            text.disabled = true

            this.loadSavedFormula()
        })
    }

    loadSavedFormula() {
        let workspace = document.getElementById("saved-formula")
        let love = document.getElementById("love-formula")
        let dimmer = document.querySelector(".dimmer")
        let buffer = '',
        b = '<hr class="my-1"/><b class="text-red">My loved formula</b> <br />'

        dimmer.classList.add('active')

        axios.get('/fill_stats/load')
        .then(response => {

            for(let show of response.data.saved) {
                buffer += `<i class="fe fe-chevron-right"></i> ${show.note} (<span class="text-primary cursor-pointer" style="cursor:pointer" onclick="App.getFromCloud(${show.id})"> show </span>) <br /> <small class="text-muted"> ${show.created} </small><br />`
            }
            workspace.innerHTML = buffer

            for(let show of response.data.loved) {
                b += `<i class="fe fe-chevron-right"></i> ${show.note} (<span class="text-primary cursor-pointer" style="cursor:pointer" onclick="App.getFromCloud(${show.id})"> show </span>)<br />`
            }

            love.innerHTML = b

            dimmer.classList.remove('active')
        }).catch(e => alert(e))
    }
}

const Cloud = new Storage();