document.getElementById("ref").addEventListener("blur", RefVerif);

function RefVerif()
{
    var ref = document.getElementById("ref");
    REGEX = new RegExp("^[\\w\\-]{1,10}$");
    if (REGEX.test(ref.value) == false)
    {
        ref.classList.remove('is-valid');
        ref.classList.add('is-invalid');
        return 1;
    }
    else
    {
        ref.classList.remove('is-invalid');
        ref.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("cat").addEventListener("blur", CatVerif);

function CatVerif()
{
    var cat = document.getElementById("cat");
    if (cat.value == 0)
    {
        cat.classList.remove('is-valid');
        cat.classList.add('is-invalid');
        return 1;
    }
    else
    {
        cat.classList.remove('is-invalid');
        cat.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("lib").addEventListener("blur", LibVerif);

function LibVerif()
{
    var lib = document.getElementById("lib");
    REGEX = new RegExp("^[\\w\\-àáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{1,200}$");
    if (REGEX.test(lib.value) == false)
    {
        lib.classList.remove('is-valid');
        lib.classList.add('is-invalid');
        return 1;
    }
    else
    {
        lib.classList.remove('is-invalid');
        lib.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("des").addEventListener("blur", DesVerif);

function DesVerif()
{
    var des = document.getElementById("des");
    if (des.value.length > 1000)
    {
        des.classList.remove('is-valid');
        des.classList.add('is-invalid');
        return 1;
    }
    else
    {
        des.classList.remove('is-invalid');
        des.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("prix").addEventListener("blur", PrixVerif);

function PrixVerif()
{
    var prix = document.getElementById("prix");
    REGEX = new RegExp("^[0-9]{1,6}[.]{0,1}[0-9]{0,2}$");
    if (REGEX.test(prix.value) == false)
    {
        prix.classList.remove('is-valid');
        prix.classList.add('is-invalid');
        return 1;
    }
    else
    {
        prix.classList.remove('is-invalid');
        prix.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("stock").addEventListener("blur", StockVerif);

function StockVerif()
{
    var stock = document.getElementById("stock");
    REGEX = new RegExp("^[0-9]{0,11}$");
    if (REGEX.test(stock.value) == false)
    {
        stock.classList.remove('is-valid');
        stock.classList.add('is-invalid');
        return 1;
    }
    else
    {
        stock.classList.remove('is-invalid');
        stock.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("color").addEventListener("blur", ColorVerif);

function ColorVerif()
{
    var color = document.getElementById("color");
    REGEX = new RegExp("^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ' ]{0,30}$");
    if (REGEX.test(color.value) == false)
    {
        color.classList.remove('is-valid');
        color.classList.add('is-invalid');
        return 1;
    }
    else
    {
        color.classList.remove('is-invalid');
        color.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("ext").addEventListener("blur", ExtVerif);

function ExtVerif()
{
    var ext = document.getElementById("ext");
    REGEX = new RegExp("^[\\w]{0,4}$");
    if (REGEX.test(ext.value) == false)
    {
        ext.classList.remove('is-valid');
        ext.classList.add('is-invalid');
        return 1;
    }
    else
    {
        ext.classList.remove('is-invalid');
        ext.classList.add('is-valid');
        return 0;
    }
}

document.getElementById("theform").addEventListener("submit", function(event){ Verif(event); });

function Verif(event)
{
    var nmbError = 0;

    nmbError = nmbError + RefVerif();
    nmbError = nmbError + CatVerif();
    nmbError = nmbError + LibVerif();
    nmbError = nmbError + DesVerif();
    nmbError = nmbError + PrixVerif();
    nmbError = nmbError + StockVerif();
    nmbError = nmbError + ColorVerif();
    nmbError = nmbError + ExtVerif();

    if (nmbError > 0)
    {
        event.preventDefault();
    }
}