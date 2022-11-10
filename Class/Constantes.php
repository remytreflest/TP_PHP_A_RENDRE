<?php

class Constantes {

    // Déclaration des différents statusCode que je souhaite utiliser au sein de ce code
    const STATUSCODE_500 = 500;
    const STATUSCODE_422 = 422;
    const STATUSCODE_401 = 401;
    const STATUSCODE_400 = 400;
    const STATUSCODE_204 = 204;
    const STATUSCODE_200 = 200;
    const STATUSCODE_500_TEXT = "INTERNAL_SERVER_ERROR";
    const STATUSCODE_422_TEXT = "UNPROCESSABLE_ENTITY";
    const STATUSCODE_401_TEXT = "UNAUTHORIZE";
    const STATUSCODE_400_TEXT = "BAD_PARAMS";
    const STATUSCODE_204_TEXT = "NO_CONTENT";
    const STATUSCODE_200_TEXT = "OK";
    
    // ROLE
    const ROLE_UTILISATEUR = 1;
    const ROLE_ADMIN = 2;
    
    // Variables permettant de personnaliser le mode de débug et même de simuler des erreurs de retour type 400 ou 500 pour ainsi tester la réaction de notre code à ces cas là.
    const DEBUG = false;
    // Fait un var_dump de l'erreur suivi d'un exit pour un débug pratique
    const SHOW_ERROR = false;
    // Booléen pour activer ou désactiver la simulation d'erreur
    const SIMULATE_STATUSCODE = false;
    // Erreur à simuler
    const INT_STATUSCODE_TO_SIMULATE = 400;
    // StatusCode d'erreurs authorisées à être simulées
    const STATUSCODES_IN_ARRAY = array(self::STATUSCODE_500, self::STATUSCODE_422, self::STATUSCODE_400);

    const ROLE_GHOST = "GHOST";
    const PRENOMS = ["YOANN", "DAMIEN", "CORENTIN"];
    const NOMS = ["COUALAN", "CHAUVEAU", "MAILLE"];
}