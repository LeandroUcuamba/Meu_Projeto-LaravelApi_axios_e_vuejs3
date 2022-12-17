<template>
  <div id="app">

    <nav>
      <div class="nav-wrapper orange darken-1">
        <a href="#" class="brand-logo center">Lista de produtos</a>
      </div>
    </nav>

    <div class="container">

      <form @submit.prevent="salvar()">

          <label>Nome</label>
          <input type="text" placeholder="Nome" v-model="produto.nome">
          <label>Quantidade</label>
          <input type="number" placeholder="QTD" v-model="produto.quantidade">
          <label>Valor</label>
          <input type="number" placeholder="Valor" v-model="produto.valor">

          <button class="waves-effect waves-light orange btn-small">Salvar <span class="mdi mdi-checkbox-multiple-marked-circle"></span></button>

      </form>

      <table>

        <thead>

          <tr>
            <th>NOME</th>
            <th>QTD</th>
            <th>VALOR</th>   
            <th>OPÇÕES</th>
          </tr>

        </thead>

        <tbody>

          <tr v-for="produto of produtos" :key="produto.id">

            <td>{{ produto.nome }}</td>
            <td>{{ produto.quantidade }}</td>
            <td>{{ produto.valor }}</td>
            <td>
              <button @click="editar(produto)" class="waves-effect btn-small blue darken-1"><span class="mdi mdi-pencil-outline"></span></button>
              <button @click="remover(produto, produto.id)"  class="waves-effect btn-small red darken-1"><span class="mdi mdi-delete"></span></button>
            </td>

          </tr>

        </tbody>
      
      </table>

    </div>

  </div>
</template>



<script>

import Produto from './services/produtos';

export default{

  data(){
    return {
       produto: {
          id: '',
          nome: '',
          quantidade: '',
          valor: ''
       },
       produtos: []
    }
  },

  mounted(){
     this.listar(); //chamada da função listar;
  },

  methods: {
     
    //criada por será reutilizada varias vezes;
    listar(){ 
      Produto.listar().then(resposta =>{
        console.log(resposta.data)
        this.produtos = resposta.data
     })
    },

     salvar(){


      if(!this.produto.id){
            Produto.salvar(this.produto).then(resposta => {
            this.produto = {}; //para limpar os campos após adicionar;
            alert('salvo com sucesso!')
            alert();
            this.listar(); //chamada da função listar;
            }).catch(e => {
               console.log(e.response.data.errors)
            })

        }else{
            Produto.atualizar(this.produto, this.produto.id).then(resposta => {
            this.produto = {}; //para limpar os campos após adicionar;
            alert('atualizado com sucesso!')
            this.listar(); //chamada da função listar;
            })

        }

     },

     editar(produto){
        this.produto = produto;
     },

     remover(produto, idRemove){
    
       if(confirm('Deseja exclui este produto?')){
            Produto.apagar(produto, idRemove).then(resposta => {
           this.listar();
             }).catch(e => {
                 console.log(e.response.data.errors)
             })
       }


        
     }


  }

}

</script>


<style>



</style>

