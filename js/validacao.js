

    const form = document.getElementById('form');
    const campos = document.querySelectorAll('.required');
    const spans = document.querySelectorAll('.span-required');


    /*Esse código é somente uma verificação, aqui diz que se ocorrer o evento
    'submit', que seria clicar no botão de cadastrar, vão acontecer todas as verificações dos inputs, 
    que estão logo embaixo*/
    /*form.addEventListener('submit', (event)=>{
        event.preventDefault();
        validarNome()
        validarTel()
        validarEndereco()

    });*/


    /*Função para implementar erro, ela pega os campos em forma de array, e aplica borda
    caso aconteça o erro, e deixa visível a mensagem de erro, que está em um span*/
    function setError(index) {
        campos[index].style.border = '2px solid red';
        spans[index].style.display = 'block';
    }

    /*E essa é a função para remover, caso aconteça a validação, essa é responsável por tirar
    tanto a borda de erro, quanto a mensagem do span, fazendo ele ter no css um 'display:none'*/
    function removeError(index){
        campos[index].style.border = '';
        spans[index].style.display = 'none';
    }
    

    /*Função validar nome, usei uma lógiga somente para validar nomes que tenham
    mais de 3 caracteres*/
    function validarNome () {
        if (campos[0].value.length < 3) {
            setError(0);
        } else {
            removeError(0);
        }
    }

    function validarTel(){
        //Comando para pegar os valores digitados no input e colocado na variavel celular
        //replace(/\D/g) é para não deixar que sejam escritos caracteres e seja substituido por vazio
        const celular = campos[1].value.replace(/\D/g, "");
        campos[1].value = celular;


        /*Em seguida pego a variavel celular que vem no formato string e uso a função split('')
        para transformar cada numero (no formato string) no formato de array, para futuramente
        calcular o tamanho do array e fazer a lógica de verificação de telefone*/
        const formatarCelular = celular.split('');




        /*Logica para verificar se o array tem o tamanho de 11 caracteres, se tiver ele não
        ele mostra a mensagem de erro, se tiver, ele apaga a mensagem*/
        if(formatarCelular.length < 11) {
            setError(1)
        } else {
            removeError(1)
        }
        //console.log(formatarCelular)
        /*Esse consolelog era só pra testar se a lógica de transformar em array
        estava correta*/
    }


    /*Função de validar endereco, aqui coloquei uma validação simples, que o endereço digitado
    precisa ter mais que 3 caracteres*/
    function validarEndereco(){
        if(campos[3].value.length <= 3) {
            setError(3);
        } else {
            removeError(3);
        }
    }


