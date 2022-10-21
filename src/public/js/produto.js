/**
 * 
 * Carrega os Produtos que já estão visualizados na linha da tabela
 * e popula os dados dos elementos inputs do formulário
 * evitando assim que nova requisição seja enviada para o servidor
 * @author Wanderlei Silva do Carmo <wander.silva@gmail.com>
 * @version 1.0
 * 
 */

 const popularFormProduto = (elem) => {
    // pega os dados do elemento pai
    const pdt = elem.parentNode.parentNode
  
    // popula os inputs do formulário
    document.getElementById("form-produto").id.value = pdt.getAttribute('data-id')
    document.getElementById("form-produto").descricao.value = pdt.getAttribute('data-descricao')
    document.getElementById("form-produto").valor_unitario.value = pdt.getAttribute('data-valor_unitario')

}
  
  const obterProdutos = () => {
      
    const produtos = document.getElementById('tb-produtos')
    
    let html = ""

    fetch('produto.php')
    .then (resp => resp.json())
    .then ( resp => {
        //const json = JSON.parse(resp)
        console.log(resp.data)

        resp.data.forEach( (e) => {
            console.log(e)
            html += `<tr data-id="${e.id}" data-descricao="${e.descricao}" 
                         data-valor_unitario="${e.valor_unitario}">

                        <td>${e.id}</td>
                        <td>${e.descricao}</td>
                        <td>${e.valor_unitario}</td>
                        <td>
                           <button type="button" onclick="popularFormProduto(this);" class="btn btn-info btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                           <button type="button" onclick="excluirProduto(${e.id})" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>`           
        })
    })
    .finally( ()  =>  produtos.innerHTML = html )
}

  
const salvarProduto = async (e) => {
  
    const id = document.getElementById('id').value;
    const descricao = document.getElementById('descricao').value;
    const valorUnitario = document.getElementById('valor_unitario').value;
       
    let formProduto = new FormData();
    formProduto.append('id', id);
    formProduto.append('descricao', descricao);
    formProduto.append('valor_unitario', valorUnitario);
      
    let salvar = undefined
      
      //console.log(formProduto.toString())
    if ( id > 0 ){
        fetch('produto.php', {
                                mode: 'cors',
                                method: 'PUT', 
                                body: new URLSearchParams(formProduto), 
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded'} 
        })
         .then(resp => resp.json())
         .then(resp => { console.log(resp);obterProdutos() })
         .catch(err => console.log(err))
                              
        console.log('atualizando...');
  
    } else {
        fetch('produto.php', {
            mode: 'cors',
            method: 'POST', 
            body: new URLSearchParams(formProduto), 
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'} 
         })
         .then(resp => resp.json())
         .then(resp => {console.log(resp); obterProdutos()})
         .catch(err => console.log(err))
  
           
         console.log('incluindo novo...')
        }
    }
  
const excluirProduto = (id) => {
      
    let formProduto = new FormData();
    formProduto.append('id', id);
      
    let salvar = undefined
      
    fetch(`produto.php?id=${id}`, {
        mode: 'cors',
        method: 'DELETE', 
        //body: new URLSearchParams(formProdutos), 
        //headers: { 'Content-Type': 'application/x-www-form-urlencoded'} 
    })
     .then(resp => resp.json())
     .then(resp => {console.log(resp); obterProdutos()})
     .catch(err => console.log(err))
  
       
     console.log('excluindo o produto...')
}
      
      