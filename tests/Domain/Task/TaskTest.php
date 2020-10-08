<?php


namespace Tests\Domain\Task;


use App\Domain\Task\Entity\Task;
use App\Domain\Task\Exceptions\TaskInvalidContentException;
use App\Domain\Task\Exceptions\TaskInvalidStatusException;
use Tests\TestCase;
use App\Domain\Task\Exceptions\TaskInvalidTitleException;

class TaskTest extends TestCase
{
    public function correctTaskProvider()
    {
        return [
            [[
                'id' => 1,
                'title' => 'Task 1',
                'content' => 'Task 1 content',
                'status' => 'active',
            ]],
            [[
                'id' => 2,
                'title' => 'Task 2',
                'content' => 'Task 2 content',
                'status' => 'completed',
            ]],
            [[
                'id' => null,
                'title' => 'Task 3',
                'content' => 'Task 3 content',
                'status' => 'active',
            ]],
            [[
                'title' => 'Task 3',
                'content' => 'Task 3 content',
                'status' => 'active',
            ]],
        ];
    }

    public function incorrectTaskProvider()
    {
        return [
            [[
                'id' => 1,
                'title' => '',
                'content' => 'Task 1 content',
                'status' => 'active',
            ]],
            [[
                'id' => 2,
                'title' => 'Task 2',
                'content' => '',
                'status' => 'completed',
            ]],
            [[
                'id' => 3,
                'title' => 'Task 2',
                'content' => '',
                'status' => 'archived',
            ]]
        ];
    }

    public function incorrectTitleTaskProvider()
    {
        return [
            [[
                'id' => 1,
                'title' => '',
                'content' => 'Task 1 content',
                'status' => 'active',
            ]],
            [[
                'id' => 1,
                'title' => 'More than 100 characters __________________________________________________________________________
                    _____________________________________________________',
                'content' => 'Task 1 content',
                'status' => 'active',
            ]],
        ];
    }

    public function incorrectContentTaskProvider()
    {
        return [
            [[
                'id' => 2,
                'title' => 'Task 2',
                'content' => '',
                'status' => 'completed',
            ]],
            [[
                'id' => 2,
                'title' => 'Task 2',
                'content' => 'More than 1000 characters ________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________
                    ____________________________________________________________________________________________________',
                'status' => 'completed',
            ]],
        ];
    }

    public function incorrectStatusTaskProvider()
    {
        return [
            [[
                'id' => 2,
                'title' => 'Task 2',
                'content' => 'Task 2',
                'status' => 'archived',
            ]],
            [[
                'id' => 2,
                'title' => 'Task 2',
                'content' => 'Task 2',
                'status' => '',
            ]],
        ];
    }

    /**
     * @dataProvider correctTaskProvider
     * @param array $data
     */
    public function testCreate(array $data)
    {
        $note = Task::create($data);
        $this->assertIsObject($note);
    }

    /**
     * @dataProvider incorrectTitleTaskProvider
     * @param array $data
     */
    public function testBadTitleCreate(array $data)
    {
        $this->expectException(TaskInvalidTitleException::class);
        $task = Task::create($data);
    }

    /**
     * @dataProvider incorrectContentTaskProvider
     * @param array $data
     */
    public function testBadContentCreate(array $data)
    {
        $this->expectException(TaskInvalidContentException::class);
        $task = Task::create($data);
    }

    /**
     * @dataProvider incorrectStatusTaskProvider
     * @param array $data
     */
    public function testBadStatusCreate(array $data)
    {
        $this->expectException(TaskInvalidStatusException::class);
        $task = Task::create($data);
    }

    /**
     * @dataProvider correctTaskProvider
     * @param array $data
     */
    public function testJsonSerialize(array $data)
    {
        $task = Task::create($data);
        $expected = [
            'id' => $data['id'] ?? null,
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status']
        ];

        $this->assertEquals($expected, $task->jsonSerialize());
    }

}