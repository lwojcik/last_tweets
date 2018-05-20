<?php

/*
 * Template rendering class
 * based on http://www.broculos.net/en/article/how-make-simple-html-template-engine-php
 */

class template {

    protected $file;
    protected $values = array();

    public function __construct($file) {
        $this->file = $file;
    }

    public function set($key, $value) {
        $this->values[$key] = $value;
    }

    public function display() {
        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).<br />";
        }
        $output = file_get_contents($this->file);

        foreach ($this->values as $key => $value) {
            $tagToReplace = "{@$key}";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }

}