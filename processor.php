<?php
error_reporting(0);
include ("stack.php");
class Processor
{
    public $st_out = array();
    public $in_out = array();
    public function main()
    {
        $parse_table = array(
          "E,i" => "TM", //E' as M
          "E,(" => "TM",
          "M,+" => "+TM",
          "M,)" => "@", //@== epsilon
          "M,$" => "@",
          "T,i" => "FY", // T' as Y
          "T,(" => "FY",
          "Y,+" => "@",
          "Y,*" => "*FY",
          "Y,)" => "@",
          "Y,$" => "$",
          "F,i" => "i",
          "F,(" => "(E)"
        );
        $stack = new Stack();
        $input = new Stack();
        $stack->push('$');$stack->push('E');
        $input->push('$');$input->push('i');$input->push('*');$input->push('i');$input->push('+');$input->push('i');
        $temp = "";
        $r = "";
        $a = ''; $b='';
        $j = 0;
        $ind = 0;
        $match = array();
        echo "<div class='row' style='margin-left: 400px'><table>";

        while (!$stack->isEmpty())
        {
            $a = $stack->top();
            $b =$input->top();
            $c =$input->top();
            if($c=='$'){
                $b ="";
                $b = '@';
            }
            $d = $input->top();
            $temp = $a.",".$b;
            $r = $parse_table[$temp];
            $stack->pop();
            for ($i = strlen($r)-1; $i>=0; $i--)
            {
                $c = $r[$i];
                if($c != '@') $stack->push($c);
            }

            if ($stack->top() == $input->top())
            {
                $this->stack_out($stack,0);
                $this->stack_out($input,0);
                $match[$ind++] = $stack->top();
                $match[$ind] = '';
                echo "<tr><td>".implode(" ",array_map('strval',$match))."</td><td>".implode(" ",array_map('strval',$this->st_out))."</td><td>".implode(" ",array_map('strval',$this->in_out))."</td><tr>";
                $stack->pop();
                $input->pop();
            }
            $j=0;
            $this->stack_out($stack,0);
            $this->input_out($input,0);
           echo "<tr><td>".implode(" ",array_map('strval',$this->st_out))."</td><td>".implode(" ",array_map('strval',$this->in_out))."</td><tr>";
        }
        echo "</table></div>";

        if($stack->isEmpty() && $input->isEmpty())
        {
            echo "<hr>Accepted By predictive parsing";
        }
        else echo "Rejected";
    }

    public function stack_out(Stack &$stack , $k)
    {
        if ($stack->isEmpty())
        {
            if ($this->st_out[$k+1] == '$')  $this->st_out[$k] = '';
            else $this->st_out[$k] = '$';
            return;
        }
        $x = $stack->top();
        $stack->pop();
        $this->st_out[++$k] = $x;
        $this->stack_out($stack,$k);
        $stack->push($x);
    }
    public function input_out(Stack &$stack , $k)
    {
        if ($stack->isEmpty())
        {
            if ($this->in_out[$k+1] == '$')  $this->in_out[$k] = '';
            else $this->in_out[$k] = '$';
            return;
        }
        $x = $stack->top();
        $stack->pop();
        $this->in_out[++$k] = $x;
        $this->input_out($stack,$k);
        $stack->push($x);
    }
}