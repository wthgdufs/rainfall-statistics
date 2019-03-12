<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Rainfall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rainfall {p}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rainfall';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $p = $this->argument("p");
        $array = explode(",",$p);
        $rainfall = $this->rained($array);
        echo "[{$p}]->{$rainfall}";
    }

    private function rained($array)
    {
        $rainfall = 0;
        $num = count($array);
        if ($num<=2)
        {
            return $rainfall;
        }
        $max_key = array_search(max($array),$array);
        if ($max_key==0)
        {//最左边界，进行递归
            unset($array[$max_key]);
            $max_key = array_search(max($array),$array);
            $max = $array[$max_key];
            foreach ($array as $k=>$v)
            {
                if ($k==$max_key)break;
                $m = $max-$v;
                $rainfall += $m>0?$m:0;
            }
            $this->rained(array_slice($array,$max_key));
        }
        elseif ($num-1==$max_key)
        {//最右边界,反转数组
            $rainfall += $this->rained(array_reverse($array));
        }
        else
        {//key位于中间,则分别取前面部分反转递归，取后面部分递归
            $rainfall += $this->rained(array_reverse(array_slice($array,0,$max_key+1)));
            $rainfall += $this->rained(array_slice($array,$max_key));
        }
        return $rainfall;
    }
}
