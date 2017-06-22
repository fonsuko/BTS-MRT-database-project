<?php
class UCSAlgorithm
{
    private $start;
    private $finish;
    private $list;

    private $priorityQueue;
    private $shortestPath = [];

    function __construct($start = "", $finish = "", $list = [])
    {
        $this->start  = $start;
        $this->finish = $finish;
        $this->list   = $list;

        // -- UCS init (insert start node)
        $this->priorityQueue = new UCSQueue();
        $this->priorityQueue->insert([[$this->start],0]);
    }


    //Main loop

    public function GetShortestPath($debug = FALSE)
    {
        $time_start = microtime(true);
        $memory_start = memory_get_usage();

        while ($this->priorityQueue->valid())
        {
            $this->Round();
        };

        $time_end = microtime(true);
        $time = $time_end - $time_start;
        $memory_finish = memory_get_usage();
        $memory = $memory_finish - $memory_start;

        if ($debug) array_push($this->shortestPath, ["Timing" => $time, "Memory" => $memory]);

        return $this->shortestPath;
    }


    //Get All Neighbors of Node

    private function GetNeighbors($host = "")
    {
        $res = [];
        foreach($this->list as $v)
        {
            if ($v["from"] == $host)
            {
                array_push($res, $v["to"]);
            };
        }
        return $res;
    }


    //Calculate distance of Path throw Nodes

    private function GetDistancePath($path=[])
    {
        $res = 0;
        for ($i=0; $i < count($path)-1; $i++)
        {
            $res = $res + $this->GetDistanceByNames($path[$i],$path[$i+1]);
        };
        return $res;
    }


    //General UCS iteration
    private function Round()
    {
        $node = array_values($this->priorityQueue->extract())[0];

        if (end($node)==$this->finish)
        {
            $this->shortestPath = [$node, $this->GetDistancePath($node)];
            $this->priorityQueue = new UCSQueue();
        }
        else
        {
            $neighborsForNode = $this->GetNeighbors(end($node));

            // children to insert to queue for next round

            foreach($neighborsForNode as $v)
            {
                $childNode = $node;
                array_push($childNode, $v);

                $this->priorityQueue->insert([$childNode, $this->GetDistancePath($childNode)]);
            };
        };
    }


    //Get distance from data list between two neighbors
    private function GetDistanceByNames($from, $to)
    {
        $res = 99999999999; // infinity
        foreach($this->list as $v)
        {
            if ($v["from"] == $from & $v["to"] == $to)
            {
                $res = $v["distance"];
            };
        }
        return $res;
    }


    //Blank for test

    public function Test()
    {
        $res = TRUE;
        // -- Construct
        if (is_string($this->start)==TRUE &
            is_string($this->finish)==TRUE &
            is_array($this->list)==TRUE)
        {
            //echo "[OK] __construct\r\n";
            $res = TRUE;
        }
        else
        {
            //echo "[FAIL] __construct\r\n";
            $res = FALSE;
        };
        return $res;
    }
}
