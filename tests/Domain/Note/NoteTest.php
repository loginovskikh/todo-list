<?php


namespace Tests\Domain\Note;


use App\Domain\Note\Entity\Note;
use App\Domain\Note\Exceptions\NoteInvalidContentException;
use App\Domain\Note\Exceptions\NoteInvalidStatusException;
use Tests\TestCase;
use App\Domain\Note\Exceptions\NoteInvalidTitleException;

class NoteTest extends TestCase
{
    public function correctNoteProvider()
    {
        return [
            [[
                'id' => 1,
                'title' => 'Note 1',
                'content' => 'Note 1 content',
                'status' => 'active',
            ]],
            [[
                'id' => 2,
                'title' => 'Note 2',
                'content' => 'Note 2 content',
                'status' => 'completed',
            ]],
            [[
                'id' => null,
                'title' => 'Note 3',
                'content' => 'Note 3 content',
                'status' => 'active',
            ]],
            [[
                'title' => 'Note 3',
                'content' => 'Note 3 content',
                'status' => 'active',
            ]],
        ];
    }

    public function incorrectNoteProvider()
    {
        return [
            [[
                'id' => 1,
                'title' => '',
                'content' => 'Note 1 content',
                'status' => 'active',
            ]],
            [[
                'id' => 2,
                'title' => 'Note 2',
                'content' => '',
                'status' => 'completed',
            ]],
            [[
                'id' => 3,
                'title' => 'Note 2',
                'content' => '',
                'status' => 'archived',
            ]]
        ];
    }

    public function incorrectTitleNoteProvider()
    {
        return [
            [[
                'id' => 1,
                'title' => '',
                'content' => 'Note 1 content',
                'status' => 'active',
            ]],
            [[
                'id' => 1,
                'title' => 'More than 100 characters __________________________________________________________________________
                    _____________________________________________________',
                'content' => 'Note 1 content',
                'status' => 'active',
            ]],
        ];
    }

    public function incorrectContentNoteProvider()
    {
        return [
            [[
                'id' => 2,
                'title' => 'Note 2',
                'content' => '',
                'status' => 'completed',
            ]],
            [[
                'id' => 2,
                'title' => 'Note 2',
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

    public function incorrectStatusNoteProvider()
    {
        return [
            [[
                'id' => 2,
                'title' => 'Note 2',
                'content' => 'Note 2',
                'status' => 'archived',
            ]],
            [[
                'id' => 2,
                'title' => 'Note 2',
                'content' => 'Note 2',
                'status' => '',
            ]],
        ];
    }

    /**
     * @dataProvider correctNoteProvider
     * @param array $data
     */
    public function testCreate(array $data)
    {
        $note = Note::create($data);
        $this->assertIsObject($note);
    }

    /**
     * @dataProvider incorrectTitleNoteProvider
     * @param array $data
     */
    public function testBadTitleCreate(array $data)
    {
        $this->expectException(NoteInvalidTitleException::class);
        $note = Note::create($data);
    }

    /**
     * @dataProvider incorrectContentNoteProvider
     * @param array $data
     */
    public function testBadContentCreate(array $data)
    {
        $this->expectException(NoteInvalidContentException::class);
        $note = Note::create($data);
    }

    /**
     * @dataProvider incorrectStatusNoteProvider
     * @param array $data
     */
    public function testBadStatusCreate(array $data)
    {
        $this->expectException(NoteInvalidStatusException::class);
        $note = Note::create($data);
    }

    /**
     * @dataProvider correctNoteProvider
     * @param array $data
     */
    public function testJsonSerialize(array $data)
    {
        $note = Note::create($data);
        $expected = [
            'id' => $data['id'] ?? null,
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status']
        ];

        $this->assertEquals($expected, $note->jsonSerialize());
    }

}