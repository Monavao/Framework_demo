<?php
/**
 * Created by PhpStorm.
 * User: monavao
 * Date: 03/02/19
 * Time: 22:09
 */

namespace Tests\App\Blog\Table;

use App\Blog\Entity\Post;
use App\Blog\Table\PostTable;
use Tests\DatabaseTestCase;

class PostTableTest extends DatabaseTestCase
{
    /**
     * @var PostTable
     */
    private $posTable;

    public function setUp()
    {
        parent::setUp();
        $this->posTable = new PostTable($this->pdo);
//        $this->pdo->beginTransaction(); // permet de faire les tests sur une vraie base de données
    }

//    public function tearDown() // permet de faire les tests sur une vraie base de données
//    {
//        $this->pdo->rollBack();
//    }

    public function testFind()
    {
        $this->seedDatabase();
        $post = $this->posTable->find(1);
        $this->assertInstanceOf(Post::class, $post);
    }

    public function testFindNotFoundRecord()
    {
        $post = $this->posTable->find(100000);
        $this->assertNull($post);
    }
}
