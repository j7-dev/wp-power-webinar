<?php

declare( strict_types = 1 );

namespace J7\PowerWebinar\Domain\FluentForm\Events\FormField;

class MyAwesome extends \FluentForm\App\Services\FormBuilder\BaseFieldManager {
    
    private const KEY = 'webinarjam_radio_field';
    
    public function __construct() {
        parent::__construct(
            self::KEY, 'WebinarJam', [ 'webinarjam' ], 'general' // where to push general/advanced
        );
        
        
        \add_filter( 'fluentform/response_render_' . $this->key, [ $this, 'renderResponse' ], 10, 4 );
        \add_filter( 'fluentform/validate_input_item_' . $this->key, [ $this, 'validateInput' ], 10, 5 );
    }
    
    /**
     * Implement your method to describe the full element
     * return $component array
     *
     * @return array<string, mixed>
     */
    public function getComponent(): array {
        $defaultGlobalMessages = \FluentForm\App\Helpers\Helper::getAllGlobalDefaultMessages();
        return [
            'index'          => 15, // The priority of your element
            'element'        => $this->key, // this is the unique identifier.
            'attributes'     => [
                'name'  => $this->key, // initial name of the input field
                'class' => '', // Custom element class holder
                'value' => '', // Default Value holder
                'type'  => 'radio',
            ],
            'settings'       => [
                'dynamic_default_value' => '',
                'container_class'       => '',
                'label'                 => '選擇報名場次',
                'admin_field_label'     => '',
                'label_placement'       => '',
                'display_type'          => '',
                'help_message'          => '',
                'randomize_options'     => 'no',
                'advanced_options'      => [
                    [
                        'label'      => '2025/01/01 20:00-21:00 直播',
                        'value'      => '2025/01/01 20:00-21:00 直播',
                        'calc_value' => '',
                        'image'      => '',
                    ],
                    [
                        'label'      => '2025/01/07 15:00-16:00 直播',
                        'value'      => '2025/01/07 15:00-16:00 直播',
                        'calc_value' => '',
                        'image'      => '',
                    ],
                ],
                'calc_value_status'     => false,
                'enable_image_input'    => false,
                'values_visible'        => false,
                'validation_rules'      => [
                    'required' => [
                        'value'          => false,
                        'message'        => $defaultGlobalMessages['required'],
                        'global_message' => $defaultGlobalMessages['required'],
                        'global'         => true,
                    ],
                ],
                'conditional_logics'    => [],
                'layout_class'          => '',
            ],
            'editor_options' => [
                'title'      => "{$this->title} Radio Field",
                'icon_class' => 'ff-edit-radio',
                'element'    => 'input-radio',
                'template'   => 'inputCheckable',
            ],
        ];
    }
    
    /*
    * 這是一個在實現您自己的元素類別時必須實現的重要方法。這個方法將回傳在表單元素的一般設定中會顯示的設定。
    */
    public function getGeneralEditorElements(): array {
        return [
            'label',
            'admin_field_label',
            'placeholder',
            'value',
            'label_placement',
            'validation_rules',
        ];
    }
    
    public function getAdvancedEditorElements() {
        return [
            'name',
            'help_message',
            'container_class',
            'class',
            'conditional_logics',
        ];
    }
    
    public function render( $data, $form ) {
        echo 'My Awesome Element Rendered';
        // print your valid html for this element
    }
    
    /**
     * @param $response string|array|number|null - Original input from form submission
     * @param $field    array - the form field component array
     * @param $form_id  - form id
     * @param $isHtml   - For HTML
     *
     * @return string
     */
    public function renderResponse( $response, $field, $form_id, $isHtml ) {
        // $response is the original input from your user
        // you can now alter the $response and return
        return $response;
    }
    
    public function validateInput( $errorMessage, $field, $formData, $fields, $form ) {
        $fieldName = $field['name'];
        if( empty( $formData[$fieldName] ) ) {
            return $errorMessage;
        }
        $value = $formData[$fieldName]; // This is the user input value
        /*
         * You can validate this value and return $errorMessage
         */
        return [ $errorMessage ];
    }
}