import React, { useState } from 'react'
import LessonItem from './LessonItem';
import {Accordion, AccordionDetails, AccordionSummary} from "@mui/material";
import {ExpandMore} from "@mui/icons-material";

function LessonList({data, MR, user, handleChangeAccordion, expanded}) {

    const [lessonsInfo, setLessonsInfo] = useState(null);
    /*console.log("data.id");
    console.log(data.id);*/
    const LessonClick = () => {
        setLessonsInfo(data["lessonInformation"].map((lessonInfo) => {
            return <LessonItem key={lessonInfo.id} data={lessonInfo} user={user} />
        }));
    }

  return (
      <Accordion expanded={expanded === data.id} sx={{margin: "10px"}} onChange={handleChangeAccordion(data.id)}>
          <AccordionSummary expandIcon={<ExpandMore />} onClick={LessonClick}>
              {MR}&nbsp;{data.name}
          </AccordionSummary>
          <AccordionDetails>
                {lessonsInfo}
          </AccordionDetails>
      </Accordion>
  )
}

export default LessonList