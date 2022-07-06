import Vue from "vue"
import axios from "axios"

axios.defaults.baseURL = 'http://localhost:8000/'
// Configurando axios para não precisar importar sempre que ele for ser usado.
Vue.use({
    install(Veu){
        Veu.prototype.$axios = axios
    }
})
