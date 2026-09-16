// Gestion des événements

document.getElementById("hamburger").addEventListener("click", afficherMasquerBarreNavigation);


// Les fonctions appelées
function afficherMasquerBarreNavigation()
{
    /* ça affiche les styles qui sont ajouter inline (dans le code HTML) */
    console.debug("Display : " + document.getElementById("barre_navigation").style.display);
    /* ça affiche les styles qui sont dans le fichier CSS */
    console.debug("Display : " + window.getComputedStyle(document.getElementById("barre_navigation")).display);
    
    if(document.getElementById("barre_navigation").style.display == "") /*  */
    {
        console.debug("Ca passe ici ???");
        document.getElementById("barre_navigation").style.display = "grid"; /* on force un nouveau style en inline */
    }
    else
    {
        console.debug("Ou la ???");
        document.getElementById("barre_navigation").style.display = "" /* On supprime le style forcé en inline */;
    }
}

