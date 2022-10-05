        // inicia a datatable
        $(document).ready(function () {

            // executa a função de listar usuários!!!!!!!!!!
            listUser();

            $('#telefone').inputmask

        });


// FUNÇÃO QUE ADICIONA USUÁRIOS!!!!!!!!!!!!!!!!!!!!!

const addUser = () =>{

    // valida de o nome foi preenchido, usando JQUERY   

    // let nome = $('#nome').val()

    // valida se o nome fooi preenchido, usando JS Vailla

    // let nome = document.getElementById('nome').value 
    // if(nome == ''){
    //     Swal.fire({
    //         icon: 'error',
    //         title:'Atenção!',
    //         text: 'Preencha o nome!'
    //     })
    //     return
    // }
    
    
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
                <td>${moment(user.data_cadastro).format('DD/MM/YY HH:mm')}</td>

                    <td> 
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="ativo" ${user.ativo==1 ? 'checked' : ''} onchange="updateUserActive(${user.id})">
                        </div>
                    </td>
               
                <td>
                <button type="button" class="btn btn-sm btn-primary" ><i class="bi bi-pencil-square"></i></button>
                <button  type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash" onclick="deleteUser(${user.id})"></i></button>
                </td>
            </tr>
        `)
    })

    // css dinamico de botao para sim e nao
    // <button type="button" class="btn btn-sm btn-${user.ativo==1 ? 'success' : 'danger'}" >
    //                 ${user.ativo==1 ? 'sim' : "não"}
    //                 </button> 


// inicia a datatable!!!!!!!!!!
$('#tabela').DataTable({
    "language": { 
        url:'//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'                    
    } 
});

})

}


// função que altera o status de ativo do usuario

const updateUserActive = (id) => {

    const result = fetch('backend/updateUserActive.php', {

        method: "POST",
        body : `id=${id}`,
        headers: {
            'content-type': 'application/x-www-form-urlencoded'
        }

    })
    .then((response) => response.json()) // retorna uma promise
    .then((result) => {

        Swal.fire({
            icon:result.retorno == 'ok' ? 'success' : 'error',
            title:result.mensagem,
            showConfirmButton: false,
            timer:2000
        })

    });

}

// ////////////////////////////////////////////////////


const deleteUser = (id) => {

    const result = fetch('backend/delete.php', {

        method: "POST",
        body : `id=${id}`,
        headers: {
            'content-type': 'application/x-www-form-urlencoded'
        }

    })
    .then((response) => response.json()) // retorna uma promise
    .then((result) => {

        Swal.fire({
            icon:result.retorno == 'ok' ? 'success' : 'error',
            title:result.mensagem,
            showConfirmButton: false,
            timer:2000
        })

        listUser()

    });

}