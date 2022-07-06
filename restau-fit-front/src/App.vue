<template>
  <div id="app">
    <router-view @logado="logando"/>
  </div>
</template>

<script>
import router from './router'

export default {
  name: 'App',
  data: function() {
    return {
        cliente: false,
        admin: false,
        logado: false,
      }
    },
  methods: {
    logando(e){
      console.log(e)
      if(e == 'Cliente'){
        router.push({name: 'Cliente'})
      }
      if(e == 'Admin'){
        router.push({name: 'Administrador'})
      }
    }
  },
  components: {
  },
  created() {
  }
}
</script>