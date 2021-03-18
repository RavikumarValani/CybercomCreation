<?php
    
    Mage::loadFileByClassName("Model_Core_Adapter");
    Mage::loadFileByClassName("Model_Core_Table");
    
    class Model_Attribute extends Model_Core_Table
    {
        const STATUS_ENABLE = 1;
        const STATUS_DISABLE = 0;
        const BACKENDTYPE_VARCHAR = 0;
        const BACKENDTYPE_INT = 1;
        const BACKENDTYPE_DECIMAL = 2;
        const BACKENDTYPE_TEXT = 3;
        const INPUTTYPE_TEXTBOX = 0;
        const INPUTTYPE_TEXTAREA = 1;
        const INPUTTYPE_SELECT = 2;
        const INPUTTYPE_CHECKBOX = 3;
        const INPUTTYPE_RADIO = 4;
        const ENTITYTYPEID_PRODUCT = 0;
        const ENTITYTYPEID_CATEGORY = 1;

        public function __construct()
        {
            $this->setTableName('attribute');
            $this->setPrimaryKey('attributeId');
        }
        
        public function getStatusOption()
        {
            return [
                self::STATUS_ENABLE => "Enable",
                self::STATUS_DISABLE => "Disable"
            ];
        }

        public function getBackEndTypeOptions()
        {
            return [
                self::BACKENDTYPE_VARCHAR => 'Varchar',
                self::BACKENDTYPE_INT => 'Int',
                self::BACKENDTYPE_TEXT => 'Text',
                self::BACKENDTYPE_DECIMAL => 'decimal'
            ];
        }

        public function getInputTypeOptions()
        {
            return [
                self::INPUTTYPE_TEXTBOX => 'Text Box',
                self::INPUTTYPE_TEXTAREA => 'Text Area',
                self::INPUTTYPE_SELECT => 'Select',
                self::INPUTTYPE_RADIO => 'Radio'
            ];
        }

        public function getEntityTypeIdOptions()
        {
            return [
                self::ENTITYTYPEID_PRODUCT => 'Product',
                self::ENTITYTYPEID_CATEGORY => 'Category'
            ];
        }

        public function getOptions()
        {
            if(!$this->attributeId)
            {
                throw new Exception('Unable To Find Id');
                
            }
            $query = "SELECT * FROM `attribute_option`
            WHERE `attributeId` = '{$this->attributeId}' 
            ORDER BY sortOrder ASC";

            return Mage::getModel('Attribute_Option')->fetchAll();
        }
    }
    
?>