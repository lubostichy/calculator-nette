<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use App\Model;

/**
 * Presenter kalkulačky.
 * @package App\Presenters
 */
class CalculatorPresenter extends Presenter
{
    /** @var int|null výsledok operácie alebo null */
    private $result = null;
    /** @var CalculatorManager Instancia triedy modelu kalkulačky */
    private $calculatorManager;
    /** Deficinicia konstant pre spravu formulara */
    const
        FORM_MSG_REQUIRE = 'Toto pole je povinné.',
        FORM_MSG_RULE = 'Toto pole má neplatný formát.';
    
    /** Predvolená vykreslovacia metóda tohto presenteru */
    public function renderDefault()
    {
        // predanie výsledku do šablóny
        $this->template->result = $this->result;
    }


    /**
     * Konštruktor s injektovanym modelom pre prácu s operáciami kalkulačky.
     * @param CalculatorManager $calculatorManager automaticky injektovana trieda modelu pre prácu s operáciami kalkulačky
     */
    public function __construct(CalculatorManager $calculatorManager)
    {
        parent::__construct();
        $this->calculatorManager = $calculatorManager;
    }
    
    /**
    * Vrati formular kalkulacky.
    * @return Form formular kalkulacky
    */
   protected function createComponentCalculatorForm()
   {
       $form = new Form;
       // ziskame existujuce operacie a dame ich do vyberu operacii
       $form->addRadioList('operation', 'Operácia:', $this->calculatorManager->getOperations())
           ->setDefaultValue(CalculatorManager::ADD)
           ->setRequired(self::FORM_MSG_REQUIRED);
       $form->addText('x', 'Prvé číslo:')
           ->setType('number')
           ->setDefaultValue(0)
           ->setRequired(self::FORM_MSG_REQUIRED)
           ->addRule(Form::INTEGER, self::FORM_MSG_RULE);
       $form->addText('y', 'Druhé číslo:')
           ->setType('number')
           ->setDefaultValue(0)
           ->setRequired(self::FORM_MSG_REQUIRED)
           ->addRule(Form::INTEGER, self::FORM_MSG_RULE)
           // Ošetříme dělení nulou.
           ->addConditionOn($form['operation'], Form::EQUAL, CalculatorManager::DIVIDE)
           ->addRule(Form::PATTERN, 'Nie je možné deliť nulou.', '^[^0].*');
       $form->addSubmit('calculate', 'Rovná sa');
       $form->onSuccess[] = [$this, 'calculatorFormSucceeded'];
       return $form;
   }

   /**
    * Funkcia sa vykona pri uspesnom odoslani formulara a spracuju sa hodnoty kalkulacky.
    * @param Form $form        formular kalkulacky
    * @param ArrayHash $values odoslane hodnoty formulara
    */
   public function calculatorFormSucceeded($form, $values)
   {
       // zisti vysledok operacie podla zvolenych hodnot a operacie
       $this->result = $this->calculatorManager->calculate($values->operation, $values->x, $values->y);
   }
}
