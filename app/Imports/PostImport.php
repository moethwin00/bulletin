<?php
/**
 * Post Importer file
 *
 * This file can work to store Data into Collection by using
 * MaatWebsite Library
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Collection;

/**
 * SystemName : Bulletinboard
 * Description : PostImport class for Data Preparation to Import
 */
class PostImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Post::create([
                'title'     => @$row[0],
                'description'    => @$row[1], 
                'status'    => @$row[2],
                'create_user_id' => Auth::user()->id,
                'updated_user_id' => Auth::user()->id,
            ]);
        }
    }
}
