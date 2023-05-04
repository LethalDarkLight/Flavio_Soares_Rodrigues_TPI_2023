<?php

class City
{
    /**
     * @var int $id L'identifiant unique de la ville
     */
    public $id;

    /**
     * @var string $name Le nom de la ville
     */
    public $name;

    /**
     * Constructeur appelé lors de la création de l'objet.
     *
     * @param int $idParam L'identifiant unique de la ville (optionnel, -1 par défaut)
     * @param string $nameParam Le nom de la ville
     */
    public function __construct($idParam = -1, $nameParam)
    {
        $this->id = $idParam;
        $this->name = $nameParam;
    }
}