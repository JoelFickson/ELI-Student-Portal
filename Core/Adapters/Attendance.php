<?php


class Attendance
{
    public static function LoadMyQuarters($StudentID)
    {
        $PST = "SELECT * FROM attendance, quarters WHERE attendance.student_id='$StudentID' AND attendance.q_uid
                    =quarters.q_uid GROUP BY attendance.q_uid";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {

            foreach ($RST as $row) {
                $QID = $row['q_uid'];
                $QName = $row['q_name'];
                $Start = $row['start'];
                $Finish = $row['finish'];
                $Level = $row['level'];
                $TotalPeriods = $row['total_periods'];
                $Status = $row['status'];

                echo "<div class='col-md-3 grid-margin stretch-card'><div class='card'>
                            
                         <div class='card-body'>
                            <h5 class='card-title'><a href='view.php?id=$QID'>$Level$QName </a> </h5>
                            <hr/>
                            <h6>Level : $Level</h6>
                            <h6>Started : $Start</h6>
                            <h6>Ends On : $Finish</h6>
                            <h6>Total Periods : $TotalPeriods</h6>
                            <h6>Status : $Status</h6></div>

                    </div> </div>";

            }

        } else {
            echo "<h4>Sorry, you are not enrolled in any quarter.</h4>";
        }

    }

    public static function LoadAttendance($Q_ID, $STUDENTID)
    {
        $PST = "SELECT  sum(attendance.periods) as total,quarters.total_periods,quarters.q_name, quarters.start
, quarters.level, quarters.start, quarters.finish
       FROM attendance, quarters
                WHERE attendance.q_uid=quarters.q_uid AND attendance.student_id='$STUDENTID' AND 
                      quarters.q_uid='$Q_ID' 
                ";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {
            foreach ($RST as $row) {

                $Attended = $row['total'];
                $Qname = $row['q_name'];
                $Periods = $row['total_periods'];
                $StartDate = $row['start'];
                $FinishDate = $row['finish'];
                $Level = $row['level'];

                $Percentage = ($Attended * 100) / $Periods;
                $Percentage = round($Percentage, 2);
                echo "<div class='col-md-6  col-md-offset-3'><div class='card'><div class='card-body'>";
                echo "<p>Class Name:  <strong> $Level$Qname</strong></p>";
                echo "<p>This quarter started on : <strong>$StartDate</strong></p>";
                echo "<p>This quarter ends on : <strong>$FinishDate</strong></p>";
                echo "<p>Total Periods For This Class : <strong>$Periods periods</strong> </p>";
                echo "<p>You have attended : <strong>$Attended periods</strong> </p>";
                echo "<p  >You attendance percentage this quarter : <strong>$Percentage%</strong></p>";

                echo "</div></div></div><br/>";
            }


        }
        self::LoadDaysAttended($Q_ID, $STUDENTID);

    }

    public static function LoadDaysAttended($Q_ID, $STUDENTID)
    {
        $PST = "SELECT attendance.date,attendance.periods, quarters.total_periods,quarters.periods_per_day  FROM attendance, quarters 
WHERE attendance.q_uid='$Q_ID'
                                     AND attendance.student_id='$STUDENTID' GROUP BY attendance.uid
                                     ";
        $RST = DSN::getInstance()->CRUD($PST);
        if ($RST->rowCount() > 0) {

            echo "<div class=\"col-md-12 text-center col-sm-12 col-xs-12\">
<br>
                <div class=\"x_panel card\">
                <br>
                        <h4>Your Attendance Summary</h4>
                        <hr>
                    <div class=\"x_content card-body\">

                        <table class=\"table table-striped\">
                            <thead>
                            <tr class=\"text-center\">
                                <th class=\"text-center\">Date Attended</th>
                                <th class=\"text-center\">Periods You Attended</th>
                                <th class=\"text-center\">Total Periods Per Day</th>
                               
                            </tr>
                            </thead>
                            <tbody>

";
            foreach ($RST as $r) {
                $Date = $r['date'];
                $Periods = $r['periods'];
                $Daily = $r['periods_per_day'];


                echo "<tr>

                                <td>$Date</td>
                                <td>$Periods</td>
                                <td>$Daily</td>
                              
                            </tr>";

            }
            echo "
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>";


        }

    }

}