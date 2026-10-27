class suma{
    constructor(numero1,numero2){
        this.numero1=numero1;
        this.numero2=numero2;
    }

    sumarNumeros(){
        return this.numero1+this.numero2;
    }
}

function sumita(){
    var num1 = parseInt(document.getElementById("txtNumero1").value);
	var num2 = parseInt(document.getElementById("txtNumero2").value);
	var op=new suma(num1,num2);
	alert(op.sumarNumeros());
}

class resta{
    constructor(numero1,numero2){
        this.numero1=numero1;
        this.numero2=numero2;
    }

    restarNumeros(){
        return this.numero1-this.numero2;
    }
}

function restita(){
    var num1 = parseInt(document.getElementById("txtNumero1").value);
	var num2 = parseInt(document.getElementById("txtNumero2").value);
	var op=new resta(num1,num2);
	alert(op.restarNumeros());
}
