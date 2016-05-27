<?php

/*
 * This file is part of the Panda framework Ui component.
 *
 * (c) Ioannis Papikas <papikas.ioan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Panda\Ui\Controls\Form;

use Exception;
use Panda\Ui\Html\HTMLDocument;

/**
 * Class FormSelect
 *
 * @package Panda\Ui\Controls\Form
 * @version 0.1
 */
class FormSelect extends FormInput
{
    /**
     * Create a new form item.
     *
     * @param HTMLDocument $HTMLDocument The DOMDocument to create the element
     *
     * @param string       $name         The input's name
     * @param string       $id           The input's id
     * @param string       $class        The input's class
     * @param bool         $multiple     Option for multiple selection.
     * @param bool         $required     Sets the input as required for the form.
     *
     * @throws Exception
     */
    public function __construct(HTMLDocument $HTMLDocument, $name = "", $id = "", $class = "", $multiple = false, $required = false)
    {
        // Create FormInput
        parent::__construct($HTMLDocument, $type = "select", $name, $id, $class, $value = "", $required);

        // Add extra attributes
        if ($multiple) {
            $this->attr("multiple", "multiple");
        }
    }

    /**
     * Add a list of options in the select.
     *
     * @param array  $options       An array of value -> title options for the select element.
     * @param string $selectedValue The selected value among the option keys.
     *
     * @return FormSelect
     * @throws Exception
     */
    public function addOptions($options = array(), $selectedValue = "")
    {
        // Create all options
        foreach ($options as $value => $title) {
            // Create option
            $fi = new FormElement($this->getDOMDocument(), "option", "", $value, "", "", $title);

            // Check if it's the selected value
            if ($value == $selectedValue) {
                $fi->attr("selected", "selected");
            }

            // Append option to select
            $this->append($fi);
        }

        // Return FormSelect object
        return $this;
    }

    /**
     * Add a list of options grouped in option groups.
     *
     * @param array  $optionGroups  An array of group labels and a nest array of option value -> title pairs.
     * @param string $selectedValue The selected value among the option keys.
     *
     * @return FormSelect
     * @throws Exception
     */
    public function addOptionsWithGroups($optionGroups = array(), $selectedValue = "")
    {
        // Create all options
        foreach ($optionGroups as $groupLabel => $options) {
            // Create option froup
            $og = new FormElement($this->getDOMDocument(), "optgroup", $name = "", $value = "", $id = "", $class = "", $itemValue = "");
            $og->attr("label", $groupLabel);

            // Create all options
            foreach ($options as $value => $title) {
                // Create option
                $fi = new FormElement($this->getDOMDocument(), "option", "", $value, "", "", $title);

                // Check if it's the selected value
                if ($value == $selectedValue) {
                    $fi->attr("selected", "selected");
                }

                // Append option to group
                $og->append($fi);
            }

            // Append option group to select
            $this->append($og);
        }

        // Return FormSelect object
        return $this;
    }
}

?>