<?php
/**
 * @file
 * Contains \Drupal\atmLogic\Form\AtmLogicForm.
 */
namespace Drupal\atmLogic\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class AtmLogicForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'atmlogic_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['cash'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Valor:'),
            '#required' => TRUE,
        );
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Calcular'),
            '#button_type' => 'primary',
        );
        return $form;
    }

      /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

        if ($form_state->getValue('cash') <= 0) {
            $form_state->setErrorByName('cash', $this->t('Por favor digite um valor maior que zero'));
        }

    }

     /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        
        $formValues = $form_state->getValues();

        $cash = $formValues['cash'];

        \Drupal::messenger()->addMessage($this->t('Form Submitted Successfully'), 'status', TRUE);
        
        while($cash > 0)
        {
            if(floor($cash / 100) > 0)
            {
                $billsQty = floor($cash/100);
                \Drupal::messenger()->addMessage($this->t($billsQty . ' cédulas de R$ 100'), 'status', TRUE);

                $cash = $cash % 100;
                continue;
            }

            if(floor($cash / 50) > 0)
            {
                $billsQty = floor($cash/50);
                \Drupal::messenger()->addMessage($this->t($billsQty . ' cédulas de R$ 50'), 'status', TRUE);

                $cash = $cash % 50;
                continue;
            }

            if(floor($cash / 10) > 0)
            {
                $billsQty = floor($cash/10);
                \Drupal::messenger()->addMessage($this->t($billsQty . ' cédulas de R$ 10'), 'status', TRUE);

                $cash = $cash % 10;
                continue;
            }

            if(floor($cash / 5) > 0)
            {
                $billsQty = floor($cash/5);
                \Drupal::messenger()->addMessage($this->t($billsQty . ' cédulas de R$ 5'), 'status', TRUE);

                $cash = $cash % 5;
                continue;
            }

            if(floor($cash / 2) > 0)
            {
                $billsQty = floor($cash/2);
                \Drupal::messenger()->addMessage($this->t($billsQty . ' cédulas de R$ 2'), 'status', TRUE);

                $cash = $cash % 2;
                continue;
            }

            if(floor($cash / 1) > 0)
            {
                $billsQty = floor($cash/1);
                \Drupal::messenger()->addMessage($this->t($billsQty . ' cédulas de R$ 1'), 'status', TRUE);

                $cash = $cash % 1;
                continue;
            }
        }
    }

}