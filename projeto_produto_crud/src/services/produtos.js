import {http} from './config'

export default {

   listar:() => {
      return http.get('/produtos')
   },

   salvar:(produto) => {
      return http.post('/produto/add', produto)
   },

   atualizar:(produto, id) => {
      const p = "/produto/"+id;
      return http.put(p, produto);
   },

   apagar:(produto, id) => {
      const p = "/produto/"+id;
      return http.delete(p, produto);
   },


}