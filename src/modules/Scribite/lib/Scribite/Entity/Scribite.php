<?php
/**
 * Copyright Scribite Team 2011
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package cribite
 * @link https://github.com/zikula-modules/Scribite
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

use Doctrine\ORM\Mapping as ORM;

/**
 * Profiles entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="scribite")
 */
class Scribite_Entity_Scribite extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $mid;


    /**
     * The following are annotations which define the modname field.
     *
     * @ORM\Column(type="string", length=64, nullable="false")
     */
    private $modname = '';


    /**
     * The following are annotations which define the modfuncs field.
     *
     * @ORM\Column(type="text", nullable="false")
     */
    private $modfuncs = '';


    /**
     * The following are annotations which define the modareas field.
     *
     * @ORM\Column(type="text", nullable="false")
     */
    private $modareas = '';


    /**
     * The following are annotations which define the modeditor field.
     *
     * @ORM\Column(type="string", length=20, nullable="false")
     */
    private $modeditor = 0;


    public function getMid() {
        return $this->mid;
    }

    public function getModname() {
        return $this->modname;
    }

    public function getModfuncs() {
        return unserialize($this->modfuncs);
    }

    public function getModareas() {
        return unserialize($this->modareas);
    }

    public function getModeditor() {
        return $this->modeditor;
    }

    public function setMid($mid) {
        $this->mid = $mid;
    }

    public function setModname($modname) {
        $this->modname = $modname;
    }

    public function setModfuncs($modfuncs)
    {
        $modfuncs = rtrim($modfuncs);
        $modfuncs = explode(',', $modfuncs);
        $this->modfuncs = serialize($modfuncs);
    }

    public function setModareas($modareas)
    {
        $modareas = rtrim($modareas);
        $modareas = explode(',', $modareas);
        $this->modareas = serialize($modareas);
    }

    public function setModeditor($modeditor) {
        $this->modeditor = $modeditor;
    }
}
