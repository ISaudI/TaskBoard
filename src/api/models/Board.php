<?php
class Board extends BaseModel {
    public $id = 0;
    public $name = '';
    public $is_active = true;
    public $columns = [];
    public $categories = [];
    public $auto_actions = [];
    public $users = [];

    public function __construct($container, $id = 0, $internal = false) {
        parent::__construct('board', $id, $container);

        if ($internal) {
            return;
        }

        $this->loadFromBean($container, $this->bean);
    }

    public static function fromBean($container, $bean) {
        $instance = new self($container, 0, true);
        $instance->loadFromBean($container, $bean);

        return $instance;
    }

    public static function fromJson($container, $json) {
        $instance = new self($container, 0, true);
        $instance->loadFromJson($container, $json);

        return $instance;
    }

    public function updateBean() {
    }

    public function loadFromBean($container, $bean) {
        if (!isset($bean->id) || $bean->id === 0) {
            return;
        }

        $this->loadPropertiesFrom($bean);

        if (isset($bean->columns)) {
            foreach($bean->columns as $item) {
                $this->columns[] = Column::fromBean($container, $item);
            }
        }

        if (isset($bean->categories)) {
            foreach($bean->categories as $item) {
                $this->categories[] = Category::fromBean($container, $item);
            }
        }

        if (isset($bean->auto_actions)) {
            foreach($bean->auto_actions as $item) {
                $this->auto_actions[] = AutoAction::fromBean($container, $item);
            }
        }

        if (isset($bean->users)) {
            foreach($bean->users as $item) {
                $this->users[] = User::fromBean($container, $item);
            }
        }

        $this->updateBean();
    }

    public function loadFromJson($container, $json) {
        $obj = json_decode($json);

        if (!isset($obj->id) || $obj->id === 0) {
            return;
        }

        $this->loadPropertiesFrom($obj);

        if (isset($obj->columns)) {
            foreach($obj->columns as $item) {
                $this->columns[] =
                    Column::fromJson($container, json_encode($item));
            }
        }

        if (isset($obj->categories)) {
            foreach($obj->categories as $item) {
                $this->categories[] =
                    Category::fromJson($container, json_encode($item));
            }
        }

        if (isset($obj->auto_actions)) {
            foreach($obj->auto_actions as $item) {
                $this->auto_actions[] =
                    AutoAction::fromJson($container, json_encode($item));
            }
        }

        if (isset($obj->users)) {
            foreach($obj->users as $item) {
                $this->users[] =
                    User::fromJson($container, json_encode($item));
            }
        }

        $this->updateBean();
    }

    private function loadPropertiesFrom($obj) {
        $this->id = (int) $obj->id;
        $this->name = $obj->name;
        $this->is_active = (bool) $obj->is_active;
    }
}
