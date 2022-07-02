import Vue from "vue"
import axios from "axios"

axios.defaults.baseURL = 'https://pokeapi.co/api/v2/pokemon'
// Configurando axios para não precisar importar sempre que ele for ser usado.
Vue.use({
    install(Veu){
        Veu.prototype.$axios = axios
    }
})
