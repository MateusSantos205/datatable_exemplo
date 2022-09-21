        // inicia a datatable
        $(document).ready(function () {

            // executa a função de listar usuários!!!!!!!!!!
            listUser();
        });


// FUNÇÃO QUE ADICIONA USUÁRIOS!!!!!!!!!!!!!!!!!!!!!

const addUser = () =>{
    
    // captura todo o formulario e cria um formData
    let form = new FormData($('#form-usuarios')[0])

    //COLOCAR NO BLOCO DE NOTAS, SEMPRE VAI USAR - envio e recebimento de dados - sempre padrão const result até o then result, sempre vai ser igual.
    const result = fetch('backend/addUser.php',{
        method: 'POST',
        body: form
    })
    // então faça ... verificar a resposta
    .then((response)=>response.json())
    // a resposta foi em formato json, se foi, pega o resultado(result) e vai fazer alguma função com ele, trata o retorno ao frontend
    .then((result)=>{
        // alert(result.Mensagem), aqui é tratado o retorno ao front
        
            Swal.fire({
            title: 'Atenção!',
            text: result.mensagem,
            icon: result.retorno == 'ok' ? 'success' : 'error'
          })

        //   limpa os campos caso o retorno tenha sucesso
        // utilização do if ternario, para redução de escrita de código
        result.retorno == 'ok' ? $('#form-usuarios')[0].reset() : ''

    })

};
// FINAL DA FUNÇÃO DE ADD USUÁRIO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// FUNÇÃO QUE LISTA OS USUÁRIOS CADASTRADOS!!!!!!!!!!!!!!!!!!!!!!
const listUser = () =>{
    const result = fetch('backend/listUser.php',{
        method: 'POST',
        body: ''
    })
    // então faça ... verificar a resposta
    .then((response)=>response.json())
    // a resposta foi em formato json, se foi, pega o resultado(result) e vai fazer alguma função com ele, trata o retorno ao frontend
    .then((result)=>{
        // aqui é tratado o retorno ao front
        // função que irá montar as linhas da tabela, o map é um tipo de laço (for)
        result.map(usuario=>{
        $('#tabela-dados').append(`
            <tr>
                <td>${usuario.nome}</td>
                <td>${usuario.email}</td>
                <td>
                <button type="button" class="btn btn-sm btn-primary"> Alterar</button>
                <button type="button" class="btn btn-sm btn-danger">Excluir</button>
                </td>
            </tr>
        `)
    })


// inicia a datatable!!!!!!!!!!
$('#tabela').DataTable({
    "language": { 
        url:'//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'                    
    }
});

})

}