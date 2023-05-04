<?php

class User
{
    /**
     * @var int $id L'identifiant unique de l'utilisateur
     */
    public $id;

    /**
     * @var string $name Le nom d'utilisateur 
     */
    public $name;

    /**
     * @var string $surname Le prénom d'utilisateur 
     */
    public $surname;

    /**
     * @var string $email L'email de l'utilisateur 
     */
    public $email;

    /**
     * @var string $password Le mot de passe haché de l'utilisateur
     */
    public $password;

    /**
     * @var string $gender Le genre de l'utilisateur 
     */
    public $gender;

    /**
     * @var string $address1 La première adresse de l'utilisateur 
     */
    public $address1;

    /**
     * @var string $address2 La deuxième adresse de l'utilisateur (optionnel)
     */
    public $address2;

    /**
     * @var string $city La ville de l'utilisateur 
     */
    public $city;

    /**
     * @var string $zipCode Le code postal de l'utilisateur 
     */
    public $zipCode;

    /**
     * @var bool $isAdmin Indique si l'utilisateur est administrateur ou non
     */
    public $isAdmin;

    /**
     * Constructeur appelé au moment de la création de l'objet. new User();
     *
     * @param int $idParam L'id unique provenant de la base de données. (Optionel) Defaut -1
     * @param string $nameParam Le nom de l'utilisateur
     * @param string $surnameParam Le prénom de l'utilisateur
     * @param string $emailParam L'email de l'utilisateur
     * @param string $passwordParam Le mot de passe de l'utilisateur
     * @param string $genderParam Le genre de l'utilisateur (homme ou femme)
     * @param string $adress1Param La première ligne de l'adresse de l'utilisateur
     * @param string $adress2Param La deuxième ligne de l'adresse de l'utilisateur
     * @param string $cityParam La ville de l'utilisateur
     * @param string $zipCodeParam Le code postal de l'utilisateur
     * @param bool $isAdminParam Détermine si l'utilisateur est un administrateur (true) ou non (false)
     */
    public function __construct($idParam = -1, $nameParam = "", $surnameParam = "", $emailParam = "", $passwordParam = "", $genderParam = "", $adress1Param = "", $adress2Param = "", $cityParam = "", $zipCodeParam = "", $isAdminParam = "")
    {
        $this->id = $idParam;
        $this->name = $nameParam;
        $this->surname = $surnameParam;
        $this->email = $emailParam;
        $this->password = $passwordParam;
        $this->gender = $genderParam;
        $this->address1 = $adress1Param;
        $this->address2 = $adress2Param;
        $this->city = $cityParam;
        $this->zipCode = $zipCodeParam;
        $this->isAdmin = $isAdminParam;
    }
}