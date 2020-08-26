<?php
/**
 * Post Exporter file
 *
 * This file can work to access Data from Collection by using
 * MaatWebsite Library
 *
 * @author     Moe Thwin Oo <scm.moethwinoo@gmail.com>
 * @copyright  Seattle Consulting Myanmar
 * @version    1.0
 * @since      File available since Release 1.0
 */

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

/**
 * SystemName : Bulletinboard
 * Description : PostExport class for Data Preparation to Export
 */
class PostExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->type == "0") {
            return Post::all();
        }
        else {
            return Post::where('create_user_id', Auth::user()->id)->get();
        }
        
    }
}
