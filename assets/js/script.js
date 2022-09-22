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
        result.retorno == 'ok' ? listUser(): ''

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

        let datahora = moment().format('DD/MM/YY HH:mm')

        $('#hr-att').html(datahora)

        // destroi a tabela que foi iniciada 
        $("#tabela").dataTable().fnDestroy()

        // limpa ps dados da tabela
        $('#tabela-dados').html('')

        // função que irá montar as linhas da tabela, o map é um tipo de laço (for)

        result.map(user=>{
        $('#tabela-dados').append(`
            <tr>
                <td>${user.nome}</td>
                <td>${user.email}</td>
                <td>
                <button type="button" class="btn btn-sm btn-primary" ><i class="bi bi-pencil-square"></i></button>
                <button type="button" class="btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
              </svg></button>
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