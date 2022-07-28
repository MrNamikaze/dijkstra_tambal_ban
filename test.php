<?php
// A PHP program for Bellman-Ford's single
// source shortest path algorithm.

// The main function that finds shortest
// distances from src to all other vertices
// using Bellman-Ford algorithm. The function
// also detects negative weight cycle
// The row graph[i] represents i-th edge with
// three values u, v and w.
function BellmanFord($graph, $V, $E, $src)
{
    // Initialize distance of all vertices as infinite.
    $dis = array();
    for ($i = 0; $i < $V; $i++)
        $dis[$i] = PHP_INT_MAX;

    // initialize distance of source as 0
    $dis[$src] = 0;

    // Relax all edges |V| - 1 times. A simple
    // shortest path from src to any other
    // vertex can have at-most |V| - 1 edges
    for ($i = 0; $i < $V - 1; $i++)
    {
        for ($j = 0; $j < $E; $j++)
        {
            if ($dis[$graph[$j][0]] != PHP_INT_MAX && $dis[$graph[$j][0]] + $graph[$j][2] <
                                $dis[$graph[$j][1]])
                $dis[$graph[$j][1]] = $dis[$graph[$j][0]] + 
                                        $graph[$j][2];
                echo $dis[$graph[0][1]].'| ';
        }
    }
    echo '<br><br>';

    // check for negative-weight cycles.
    // The above step guarantees shortest
    // distances if graph doesn't contain
    // negative weight cycle. If we get a
    // shorter path, then there is a cycle.
    for ($i = 0; $i < $E; $i++)
    {
        $x = $graph[$i][0];
        $y = $graph[$i][1];
        $weight = $graph[$i][2];
        if ($dis[$x] != PHP_INT_MAX &&
            $dis[$x] + $weight < $dis[$y])
            echo "Graph contains negative weight cycle \n";
    }

    echo "Vertex Distance from Source <br>";
    for ($i = 0; $i < $V; $i++)
        echo $i, "||||||||||||", $dis[$i],"|||||||||",var_dump(),"<br><br>";
}

// Driver Code
$V = 5; // Number of vertices in graph
$E = 8; // Number of edges in graph

// Every edge has three values (u, v, w) where
// the edge is from vertex u to v. And weight
// of the edge is w.
$graph = array( array( 0, 1, -1 ), array( 0, 2, 4 ),
                array( 1, 2, 3 ), array( 1, 3, 2 ),
                array( 1, 4, 2 ), array( 3, 2, 5),
                array( 3, 1, 1), array( 4, 3, -3 ) );

BellmanFord($graph, $V, $E, 0);

// This code is contributed by AnkitRai01
?>
