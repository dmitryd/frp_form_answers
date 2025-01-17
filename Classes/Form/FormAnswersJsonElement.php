<?php

namespace Frappant\FrpFormAnswers\Form;

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class FormAnswersJsonElement extends AbstractFormElement
{
    public function render()
    {
        // Custom TCA properties and other data can be found in $this->data, for example the above
        // parameters are available in $this->data['parameterArray']['fieldConf']['config']['parameters']
        $resultArray = $this->initializeResultArray();
        $fieldValues = json_decode($this->data['databaseRow']['answers'], true);

        $out = '<ul>';

        if (is_array($fieldValues)) {
            foreach ($fieldValues as $fieldKey => $fieldValue) {
                if ($fieldValue['conf']['label']) {
                    $out .= '<li>'.$fieldValue['conf']['label'].' - '.(is_array($fieldValue['value']) ? implode(",", htmlspecialchars($fieldValue['value'])) : htmlspecialchars($fieldValue['value'])).'</li>';
                } else {
                    $out .= '<li>'.$fieldKey.' - '.(is_array($fieldValue['value']) ? implode(",", htmlspecialchars($fieldValue['value'])) : htmlspecialchars($fieldValue['value'])).'</li>';
                }
            }
        }
        $out .= '</ul>';

        $resultArray['html'] = $out;
        return $resultArray;
    }
}
