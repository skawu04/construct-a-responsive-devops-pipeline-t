<?php

// Data model for responsive DevOps pipeline tracker

class Pipeline {
    public $id;
    public $name;
    public $stages = [];
    public $status;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->status = 'pending';
    }

    function addStage($stage) {
        $this->stages[] = $stage;
    }
}

class Stage {
    public $id;
    public $name;
    public $tasks = [];
    public $status;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->status = 'pending';
    }

    function addTask($task) {
        $this->tasks[] = $task;
    }
}

class Task {
    public $id;
    public $name;
    public $status;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->status = 'pending';
    }
}

$pipelines = [];

// Example data
$pipelines[] = new Pipeline(1, 'Pipeline 1');
$pipelines[0]->addStage(new Stage(1, 'Stage 1'));
$pipelines[0]->addStage(new Stage(2, 'Stage 2'));
$pipelines[0]->stages[0]->addTask(new Task(1, 'Task 1'));
$pipelines[0]->stages[0]->addTask(new Task(2, 'Task 2'));
$pipelines[0]->stages[1]->addTask(new Task(3, 'Task 3'));
$pipelines[0]->stages[1]->addTask(new Task(4, 'Task 4'));

$pipelines[] = new Pipeline(2, 'Pipeline 2');
$pipelines[1]->addStage(new Stage(3, 'Stage 3'));
$pipelines[1]->addStage(new Stage(4, 'Stage 4'));
$pipelines[1]->stages[0]->addTask(new Task(5, 'Task 5'));
$pipelines[1]->stages[0]->addTask(new Task(6, 'Task 6'));
$pipelines[1]->stages[1]->addTask(new Task(7, 'Task 7'));
$pipelines[1]->stages[1]->addTask(new Task(8, 'Task 8'));

// Function to update pipeline status
function updatePipelineStatus($pipelineId, $status) {
    global $pipelines;
    foreach ($pipelines as $pipeline) {
        if ($pipeline->id == $pipelineId) {
            $pipeline->status = $status;
            foreach ($pipeline->stages as $stage) {
                $stage->status = $status;
                foreach ($stage->tasks as $task) {
                    $task->status = $status;
                }
            }
        }
    }
}

// Function to update stage status
function updateStageStatus($pipelineId, $stageId, $status) {
    global $pipelines;
    foreach ($pipelines as $pipeline) {
        if ($pipeline->id == $pipelineId) {
            foreach ($pipeline->stages as $stage) {
                if ($stage->id == $stageId) {
                    $stage->status = $status;
                    foreach ($stage->tasks as $task) {
                        $task->status = $status;
                    }
                }
            }
        }
    }
}

// Function to update task status
function updateTaskStatus($pipelineId, $stageId, $taskId, $status) {
    global $pipelines;
    foreach ($pipelines as $pipeline) {
        if ($pipeline->id == $pipelineId) {
            foreach ($pipeline->stages as $stage) {
                if ($stage->id == $stageId) {
                    foreach ($stage->tasks as $task) {
                        if ($task->id == $taskId) {
                            $task->status = $status;
                        }
                    }
                }
            }
        }
    }
}

?>