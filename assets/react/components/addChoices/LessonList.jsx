import React, { useState } from 'react'
import LessonItem from './LessonItem';
import {Accordion, AccordionDetails, AccordionSummary, useMediaQuery, useTheme} from "@mui/material";
import {ExpandMore} from "@mui/icons-material";
import { useSelector, useDispatch } from "react-redux";
import { setActive} from "../../store/slices/accordion";

function LessonList({data, MR, user}) {

    const theme = useTheme();
    const isSmallScreen = useMediaQuery(theme.breakpoints.down("md"));
    const [lessonsInfo, setLessonsInfo] = useState(null);
    const accordionRedux = useSelector((state) => state.accordion);
    const dispatch = useDispatch();
    const LessonClick = () => {
        setLessonsInfo(data["lessonInformation"].map((lessonInfo) => {
            return <LessonItem key={lessonInfo.id} data={lessonInfo} user={user} />
        }));
    }

    const handleChangeAccordion = (panel) => (event, isExpanded) => {
        if (panel === accordionRedux.active) {
            dispatch(setActive(false));
        } else {
            dispatch(setActive(panel));
        }
    }

  return (
      <Accordion
          expanded={accordionRedux.active === data.id}
          sx={{margin: "10px", backgroundColor: "secondary.main", display: "flex", flexDirection: "column", alignItems: "center"}}
          onChange={handleChangeAccordion(data.id)}>
          <AccordionSummary expandIcon={<ExpandMore />} onClick={LessonClick} sx={{width: "auto"}}>
              {MR}&nbsp;{data.name}
          </AccordionSummary>
          <AccordionDetails sx={{justifyContent:"center", alignItems: "center", display: "flex",
              ...(isSmallScreen
                  ? { flexDirection: "column" }
                  : { flexDirection: "row" })
            }}
          >
                {lessonsInfo}
          </AccordionDetails>
      </Accordion>
  )
}

export default LessonList