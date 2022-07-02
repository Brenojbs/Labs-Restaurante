<template id='Tela-Admin'>
    <div>
      <div>
        <router-link class="m-1" to="/">Sair</router-link>
      </div>
      <h1 class="mx-auto" style="width: 200px;">
        <p class="p">Cadastrar Pratos!</p>
      </h1>
      <div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Imagem</th>
              <th>Categoria</th>
              <th>Preço</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items" :key="index">
              <th scope="row" >{{ item.nome }}</th>
              <td size="sm">
                <img src={item.imagem} alt="Carne de panela">
              </td>
              <td>{{ item.preço }}</td>
            </tr>
          </tbody>
        </table>
      </div>
	</div>
</template>

<script>
export default {
	name: 'Tela-Admin',
	data() {
		return {
			listaDePratos: [],
		}
	}
}
</script>