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
      if(e == 'cliente'){
        router.push({name: 'cliente'})
      }
      if(e == 'admin'){
        router.push({name: 'admin'})
      }
    }
  },
  components: {
  },
  created() {
  }
}
</script>