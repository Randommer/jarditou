function Validation(contact)
{
    var check = true;
    var REGEX;

    if (contact.elements['nom'].value.length == 0)
    {
        contact.elements['nom'].classList.remove('is-valid');
        contact.elements['nom'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['nom'].classList.remove('is-invalid');
        contact.elements['nom'].classList.add('is-valid');
    }

    if (contact.elements['prenom'].value.length == 0)
    {
        contact.elements['prenom'].classList.remove('is-valid');
        contact.elements['prenom'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['prenom'].classList.remove('is-invalid');
        contact.elements['prenom'].classList.add('is-valid');
    }

    if (contact.elements['sexe'].value.length == 0)
    {
        contact.elements['feminin'].classList.remove('is-valid');
        contact.elements['feminin'].classList.add('is-invalid');
        contact.elements['masculin'].classList.remove('is-valid');
        contact.elements['masculin'].classList.add('is-invalid');
        contact.elements['neutre'].classList.remove('is-valid');
        contact.elements['neutre'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['feminin'].classList.remove('is-invalid');
        contact.elements['feminin'].classList.add('is-valid');
        contact.elements['masculin'].classList.remove('is-invalid');
        contact.elements['masculin'].classList.add('is-valid');
        contact.elements['neutre'].classList.remove('is-invalid');
        contact.elements['neutre'].classList.add('is-valid');
    }
    
    if (Date.parse(contact.elements['naissance'].value) >= Date.now() || contact.elements['naissance'].value == "")
    {
        contact.elements['naissance'].classList.remove('is-valid');
        contact.elements['naissance'].classList.add('is-invalid');
        check = false;
        if (Date.parse(contact.elements['naissance'].value) >= Date.now())
        {
            document.getElementById('naissance-invalid').innerHTML = "A part si vous êtes né dans le futur, selectionnez une date passée ;-)";
        }
    }
    else
    {
        contact.elements['naissance'].classList.remove('is-invalid');
        contact.elements['naissance'].classList.add('is-valid');
    }

    REGEX = new RegExp("^[0-9]{5}$");
    if (REGEX.test(contact.elements['CP'].value) == false)
    {
        contact.elements['CP'].classList.remove('is-valid');
        contact.elements['CP'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['CP'].classList.remove('is-invalid');
        contact.elements['CP'].classList.add('is-valid');
    }

    REGEX = new RegExp("[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})");
    if (REGEX.test(contact.elements['email'].value) == false)
    {
        contact.elements['email'].classList.remove('is-valid');
        contact.elements['email'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['email'].classList.remove('is-invalid');
        contact.elements['email'].classList.add('is-valid');
    }

    if (contact.elements['sujet'].value.length == 0)
    {
        contact.elements['sujet'].classList.remove('is-valid');
        contact.elements['sujet'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['sujet'].classList.remove('is-invalid');
        contact.elements['sujet'].classList.add('is-valid');
    }

    if (contact.elements['question'].value.length == 0)
    {
        contact.elements['question'].classList.remove('is-valid');
        contact.elements['question'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['question'].classList.remove('is-invalid');
        contact.elements['question'].classList.add('is-valid');
    }

    if (contact.elements['accepted'].value != "true")
    {
        contact.elements['accepted'].classList.remove('is-valid');
        contact.elements['accepted'].classList.add('is-invalid');
        check = false;
    }
    else
    {
        contact.elements['accepted'].classList.remove('is-invalid');
        contact.elements['accepted'].classList.add('is-valid');
    }
        
    return check;
}