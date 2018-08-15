<?php
	$rbac = ['read'];

	$rs = (bool) in_array('read',$rbac);
	var_dump($rs);
	



 exit();
 $json ='{
    "current_category_competency": 6,
    "current_section": "competency",
    "progress_personality": 35,
    "progress_competency": 30,
    "current_category_personality": 5,
    "competency": [{
        "score": 4,
        "question": [{
            "question": {
                "id": 5,
                "diff": 1,
                "category_id": 1,
                "question": "ของที่ฉันแช่ไว้ในตู้เย็นหายไป เช่น ไอกรีม ผลไม้ Yoghurt หรือนมสด"
            },
            "answer": {
                "id": 20,
                "question_id": 5,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันยอมรับว่าเป็นความผิดของฉันเอง และมองหาวิธีที่จะไม่โดนขโมยอีก",
                "uid": "e59f2e99-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:512"
            },
            "time": 1
        }, {
            "question": {
                "id": 1,
                "diff": 1,
                "category_id": 1,
                "question": "เมื่อฉันสูญเสียของที่ฉันรัก เช่น บุคคลสำคัญ สัตว์เลี้ยง กระเป๋าสตางค์ ของสำคัญ"
            },
            "answer": {
                "id": 2,
                "question_id": 1,
                "choice_id": 2,
                "point": 1,
                "label": "ทั้ง ๆ ที่ฉันไม่ได้เล่าให้ใครฟัง แต่เพื่อนของฉันก็สัมผัสความรู้สึกของฉันได้",
                "uid": "e59c3d4f-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:529"
            },
            "time": 1
        }, {
            "question": {
                "id": 8,
                "diff": 2,
                "category_id": 1,
                "question": "เพื่อนสนิทต่อว่า ทำร้ายจิตใจฉันอย่างรุนแรง"
            },
            "answer": {
                "id": 29,
                "question_id": 8,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันลงมือตอบโต้กลับไปทันที ไม่สนใจ แรงมาก็แรงกลับ เป็นคนตรง ๆ",
                "uid": "e5a0adb0-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:547"
            },
            "time": 0
        }, {
            "question": {
                "id": 7,
                "diff": 2,
                "category_id": 1,
                "question": "เวลาที่ฉันเจอคุณป้าคนหนึ่ง แทรกแถวที่ฉันต่ออยู่"
            },
            "answer": {
                "id": 25,
                "question_id": 7,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันไม่พอใจ และต่อว่าในทันที",
                "uid": "e59fe752-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:565"
            },
            "time": 0
        }, {
            "question": {
                "id": 6,
                "diff": 2,
                "category_id": 1,
                "question": "เมื่อฉันถูกแกล้ง"
            },
            "answer": {
                "id": 21,
                "question_id": 6,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันลงมือตอบโต้กลับไปทันที ไม่สนใจ แรงมาก็แรงกลับ เป็นคนตรง ๆ",
                "uid": "e59f4cd3-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:586"
            },
            "time": 2
        }],
        "category_id": 1
    }, {
        "score": 10,
        "question": [{
            "question": {
                "id": 12,
                "diff": 1,
                "category_id": 2,
                "question": "ส่วนใหญ่แล้ว เวลาทำงานกลุ่ม"
            },
            "answer": {
                "id": 46,
                "question_id": 12,
                "choice_id": 2,
                "point": 1,
                "label": "ฉันก็นั่งทำงานอยู่กับเพื่อน ชิว ๆ",
                "uid": "e5a438c4-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:604"
            },
            "time": 1
        }, {
            "question": {
                "id": 13,
                "diff": 1,
                "category_id": 2,
                "question": "เวลาฉันไปเที่ยวตามสถานที่ต่าง ๆ เช่น ทัศนศึกษา เข้าค่ายลูกเสือ ฯลฯ"
            },
            "answer": {
                "id": 50,
                "question_id": 13,
                "choice_id": 2,
                "point": 1,
                "label": "ฉันพูดมาก เล่าเรื่องตลกโปกฮา เม้าธ์มอย กับเพื่อนฉัน",
                "uid": "e5a4f239-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:622"
            },
            "time": 1
        }, {
            "question": {
                "id": 11,
                "diff": 1,
                "category_id": 2,
                "question": "ในวัน CU First Date ที่ผ่านมา"
            },
            "answer": {
                "id": 41,
                "question_id": 11,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันเข้ากิจกรรมคนเดียว รู้สึกอึดอัดเมื่อต้องอยู่ท่ามกลางผู้คน",
                "uid": "e5a36ead-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:640"
            },
            "time": 1
        }, {
            "question": {
                "id": 15,
                "diff": 1,
                "category_id": 2,
                "question": "ที่โรงเรียนเก่า ในห้องเรียนของฉัน"
            },
            "answer": {
                "id": 59,
                "question_id": 15,
                "choice_id": 3,
                "point": 2,
                "label": "ฉันคอยช่วยเหลือเพื่อน เวลาทำการบ้าน หรือมีปัญหาต่าง ๆ",
                "uid": "e5a65e7d-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:658"
            },
            "time": 1
        }, {
            "question": {
                "id": 16,
                "diff": 2,
                "category_id": 2,
                "question": "เวลาที่เพื่อนในกลุ่มของฉันทะเลาะกัน"
            },
            "answer": {
                "id": 64,
                "question_id": 16,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันวางแผนให้ 2 คน ได้เปิดใจคุยกัน ให้รู้เรื่อง เอาให้ Clear ให้สนิทกันเหมือนเดิม",
                "uid": "e5a705af-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:676"
            },
            "time": 1
        }],
        "category_id": 2
    }, {
        "score": 5,
        "question": [{
            "question": {
                "id": 24,
                "diff": 1,
                "category_id": 3,
                "question": "ฉันพบปัญหาเล็ก ๆ ในโรงเรียน หรือชุมชน ของฉัน เช่น ห้องน้ำเสีย ไฟดับ แอร์พัง น้ำเหม็น เศษขยะรกรุงรัง"
            },
            "answer": {
                "id": 96,
                "question_id": 24,
                "choice_id": 4,
                "point": 3,
                "label": "ต้องทำอะไรซักอย่างแล้วล่ะ ฉันทนอยู่เฉยไม่ได้แล้ว ลุกขึ้นมาทำโครงการเองก็ได้",
                "uid": "e5ab540c-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:693"
            },
            "time": 1
        }, {
            "question": {
                "id": 21,
                "diff": 1,
                "category_id": 3,
                "question": "เมื่อโรงเรียนต้องการอาสาสมัคร โครงการช่วยเหลือสังคม เช่น ปลูกป่าชายเลน หรือค่ายอาสา"
            },
            "answer": {
                "id": 83,
                "question_id": 21,
                "choice_id": 3,
                "point": 2,
                "label": "ฉันไปหาความรู้ เพื่อช่วยเหลือโครงการ เช่น ทำเสื้อผ้าขายเพื่อระดมทุน",
                "uid": "e5a9803d-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:711"
            },
            "time": 1
        }, {
            "question": {
                "id": 28,
                "diff": 2,
                "category_id": 3,
                "question": "เมื่อวันพระที่ผ่านมา ฉันไปวัด และพบรองเท้าวางเกะกะทางเดิน"
            },
            "answer": {
                "id": 109,
                "question_id": 28,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันไม่ได้ใส่ใจอะไร ก็มันเป็นเรื่องปกติที่ทุกคนเค้าทำกัน",
                "uid": "e5ad62f0-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:730"
            },
            "time": 1
        }, {
            "question": {
                "id": 28,
                "diff": 2,
                "category_id": 3,
                "question": "เมื่อวันพระที่ผ่านมา ฉันไปวัด และพบรองเท้าวางเกะกะทางเดิน"
            },
            "answer": {
                "id": 109,
                "question_id": 28,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันไม่ได้ใส่ใจอะไร ก็มันเป็นเรื่องปกติที่ทุกคนเค้าทำกัน",
                "uid": "e5ad62f0-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:730"
            },
            "time": 1
        }, {
            "question": {
                "id": 26,
                "diff": 2,
                "category_id": 3,
                "question": "ในโรงพยาบาล เมื่อฉันเจอคนท้องขอความช่วยเหลือ เช่น ถือของหรือเปิดประตู"
            },
            "answer": {
                "id": 101,
                "question_id": 26,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันเฝ้ามองดูเฉย ๆ",
                "uid": "e5ac3080-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:765"
            },
            "time": 1
        }],
        "category_id": 3
    }, {
        "score": 15,
        "question": [{
            "question": {
                "id": 35,
                "diff": 1,
                "category_id": 4,
                "question": "เวลาที่ฉันตั้งเป้าหมาย กฎกติกาต่าง ๆ ให้ตนเอง เช่น ลดความอ้วน ตื่นเช้า ออกกำลังกาย"
            },
            "answer": {
                "id": 140,
                "question_id": 35,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันท้าทายตัวเองมากขึ้นทุกครั้ง เพราะฉันรู้สึกว่าคนเราต้องชนะตนเองให้ได้",
                "uid": "e5b24c3e-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:783"
            },
            "time": 1
        }, {
            "question": {
                "id": 31,
                "diff": 1,
                "category_id": 4,
                "question": "เมื่อฉันต้องเป็นเวรทำความสะอาดในห้องเรียน"
            },
            "answer": {
                "id": 123,
                "question_id": 31,
                "choice_id": 3,
                "point": 2,
                "label": "ฉันทำเวรฉันเสร็จแล้ว แต่ไหน ๆ ก็ทำละ ก็ช่วยเพื่อนคนอื่นต่อเลยละกัน",
                "uid": "e5afef47-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:802"
            },
            "time": 1
        }, {
            "question": {
                "id": 37,
                "diff": 2,
                "category_id": 4,
                "question": "เมื่อเพื่อนที่รู้จักกันมานานตั้งแต่ ม.ต้น ขอให้ฉันช่วย"
            },
            "answer": {
                "id": 146,
                "question_id": 37,
                "choice_id": 2,
                "point": 1,
                "label": "ก็ถ้ารับปากไว้แล้ว ฉันก็จะทำให้เสร็จตามที่สัญญา",
                "uid": "e5b2fbaa-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:820"
            },
            "time": 1
        }, {
            "question": {
                "id": 36,
                "diff": 2,
                "category_id": 4,
                "question": "ฉันพบว่าเพื่อนสนิทกำลังท้อแท้ หมดกำลังใจ"
            },
            "answer": {
                "id": 143,
                "question_id": 36,
                "choice_id": 3,
                "point": 2,
                "label": "ฉันปลอบเพื่อนจนมีกำลังใจ ไม่กลับมาท้อแท้ อีกในระยะยาว",
                "uid": "e5b2a65a-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:838"
            },
            "time": 1
        }, {
            "question": {
                "id": 38,
                "diff": 2,
                "category_id": 4,
                "question": "เวลานัดหมายทานข้าว หรือไปเที่ยวกับเพื่อน ๆ"
            },
            "answer": {
                "id": 151,
                "question_id": 38,
                "choice_id": 3,
                "point": 2,
                "label": "ฉันมาก่อนเวลา พร้อมสำรวจร้านอาหาร สถานที่ต่าง ๆ ด้วย",
                "uid": "e5b390c5-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:856"
            },
            "time": 1
        }],
        "category_id": 4
    }, {
        "score": 12,
        "question": [{
            "question": {
                "id": 43,
                "diff": 1,
                "category_id": 5,
                "question": "หากพูดถึงเป้าหมายในชีวิตของฉัน"
            },
            "answer": {
                "id": 169,
                "question_id": 43,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันใช้ชีวิตเรื่อย ๆ ไม่คิดอะไรมากมาย",
                "uid": "e5b5d214-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:874"
            },
            "time": 1
        }, {
            "question": {
                "id": 44,
                "diff": 1,
                "category_id": 5,
                "question": "เมื่อฉันและเพื่อน ๆ สั่งอาหารไปตั้งนานแล้ว แต่มาพบทีหลังว่าอาหารหมด"
            },
            "answer": {
                "id": 173,
                "question_id": 44,
                "choice_id": 1,
                "point": 0,
                "label": "วีนค่ะ! ฉันไม่พอใจ เรียกพนักงานมาต่อว่า",
                "uid": "e5b648aa-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:891"
            },
            "time": 1
        }, {
            "question": {
                "id": 45,
                "diff": 1,
                "category_id": 5,
                "question": "จากวันนี้ไป จะเข้าเรียนที่จุฬาฯ แล้ว"
            },
            "answer": {
                "id": 180,
                "question_id": 45,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันเตรียมพร้อม และปรับกิจวัตรประจำวัน เช่น เวลาตื่น การเดินทาง ตามความเหมาะสม เช่น ฝนตก หรือมีเรียนตอนเช้า",
                "uid": "e5b77609-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:910"
            },
            "time": 1
        }, {
            "question": {
                "id": 42,
                "diff": 1,
                "category_id": 5,
                "question": "เวลาฉันท่องเที่ยว หรือไปค้างแรมนอกสถานที่ กับคนอื่น เช่น ทัศนศึกษา ค่ายลูกเสือ หรือไปเที่ยวต่างจังหวัด"
            },
            "answer": {
                "id": 168,
                "question_id": 42,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันชอบที่จะเป็นตัวตั้งตัวตี วางแผนกิจกรรมต่าง ๆ มีอะไรมาถามฉันได้ทั้งหมดเลย",
                "uid": "e5b5b270-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:927"
            },
            "time": 1
        }, {
            "question": {
                "id": 46,
                "diff": 2,
                "category_id": 5,
                "question": "เมื่อกำลังทำกิจกรรมรับน้องกลางแจ้งที่โรงเรียน แต่จู่ ๆ ฝนก็ตกลงมา"
            },
            "answer": {
                "id": 184,
                "question_id": 46,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันคาดไว้แล้วว่าฝนอาจตก จึงเอาแผนสำรองที่คิดไว้ก่อนแล้วมาใช้",
                "uid": "e5b8119a-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:945"
            },
            "time": 1
        }],
        "category_id": 5
    }, {
        "score": 5,
        "question": [{
            "question": {
                "id": 55,
                "diff": 1,
                "category_id": 6,
                "question": "เกี่ยวกับการใช้เทคโนโลยีในการทำกิจกรรม"
            },
            "answer": {
                "id": 217,
                "question_id": 55,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันรู้สึกว่า เทคโนโลยีต่าง ๆ ทำให้การทำงานของฉันยุ่งยากมากขึ้น",
                "uid": "e5bd3b27-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:963"
            },
            "time": 1
        }, {
            "question": {
                "id": 53,
                "diff": 1,
                "category_id": 6,
                "question": "ในคาบเรียนวิชาคอมพิวเตอร์ หรือวิชาที่เกี่ยวข้องกับเทคโนโลยี"
            },
            "answer": {
                "id": 209,
                "question_id": 53,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันอึดอัดกับเวลาเรียน และพยายามหาสิ่งอื่นทำแทน",
                "uid": "e5bc416b-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:982"
            },
            "time": 1
        }, {
            "question": {
                "id": 51,
                "diff": 1,
                "category_id": 6,
                "question": "เมื่อฉันค้นคว้าหาความรู้ใหม่ ๆ"
            },
            "answer": {
                "id": 203,
                "question_id": 51,
                "choice_id": 3,
                "point": 2,
                "label": "ฉันค้นคว้าศึกษาข้อมูล Online จากหลาย ๆ แหล่ง และใช้เวลาทำความเข้าใจ ก่อนสรุปผล",
                "uid": "e5baf236-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:999"
            },
            "time": 2
        }, {
            "question": {
                "id": 54,
                "diff": 1,
                "category_id": 6,
                "question": "เมื่อฉันต้องค้นคว้า หาข้อมูลบางอย่าง จำนวนมาก"
            },
            "answer": {
                "id": 213,
                "question_id": 54,
                "choice_id": 1,
                "point": 0,
                "label": "ฉันสัมภาษณ์ผู้เชี่ยวชาญ เพื่อสอบถามข้อมูลเชิงลึกด้านต่าง ๆ",
                "uid": "e5bcc654-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:1017"
            },
            "time": 1
        }, {
            "question": {
                "id": 52,
                "diff": 1,
                "category_id": 6,
                "question": "หากพูดถึงเทคโนโลยี ต่าง ๆ เช่น Facebook, LINE, MS Excel, Photoshop, AI, Game"
            },
            "answer": {
                "id": 208,
                "question_id": 52,
                "choice_id": 4,
                "point": 3,
                "label": "ฉันสามารถพัฒนา App พวกนั้นได้เองเลยล่ะ",
                "uid": "e5bc01b9-6784-11e7-94fd-b888e3621708",
                "$$hashKey": "object:1035"
            },
            "time": 1
        }],
        "category_id": 6
    }],
    "personality": [{
        "score": 3,
        "question": [{
            "question": {
                "id": 62,
                "diff": 1,
                "category_id": 1,
                "question": "ฉันเป็นคนยังไงในกลุ่มเพื่อน"
            },
            "answer": {
                "id": 244,
                "question_id": 62,
                "choice_id": 2,
                "point": -1,
                "label": "มักเป็นคนเริ่มชวนคุยหรือชักชวนกลุ่มเพื่อนในการเริ่มทำกิจกรรมต่าง ๆ อยู่เสมอ",
                "uid": "5dea023a-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:79"
            },
            "time": 2
        }, {
            "question": {
                "id": 65,
                "diff": 1,
                "category_id": 1,
                "question": "ฉันเพิ่งสอบคัดเลือก หรือทำกิจกรรมที่ต้องใช้พลังงานเยอะมากเสร็จ ถ้าเลือกได้ ฉันจะ..."
            },
            "answer": {
                "id": 249,
                "question_id": 65,
                "choice_id": 1,
                "point": 1,
                "label": "ทำกิจกรรมส่วนตัว อยู่กับตัวเอง เช่น อ่านหนังสือ ฟังเพลง หรือนอน",
                "uid": "",
                "$$hashKey": "object:90"
            },
            "time": 0
        }, {
            "question": {
                "id": 64,
                "diff": 1,
                "category_id": 1,
                "question": "เมื่อถูกถามถึงเรื่องส่วนตัวมาก ๆ ฉันจะ..."
            },
            "answer": {
                "id": 248,
                "question_id": 64,
                "choice_id": 2,
                "point": 1,
                "label": "ไม่ตอบถ้าไม่จำเป็น หรือถ้าต้องตอบก็จะระมัดระวังมาก",
                "uid": "5deab3b3-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:103"
            },
            "time": 1
        }, {
            "question": {
                "id": 67,
                "diff": 1,
                "category_id": 1,
                "question": "ฉันรู้สึกยังไง ถ้าต้องทำกิจกรรมร่วมกับคนอื่น ๆ"
            },
            "answer": {
                "id": 254,
                "question_id": 67,
                "choice_id": 2,
                "point": -1,
                "label": "ฉันรู้สึกสนุก มั่นใจ เพราะมักทำกิจกรรมแบบนี้อยู่แล้ว",
                "uid": "5debb934-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:115"
            },
            "time": 1
        }, {
            "question": {
                "id": 63,
                "diff": 1,
                "category_id": 1,
                "question": "ในวัน CU First Date ที่ฉันยังไม่รู้จักใครมาก่อน ถ้ามาถึงก่อนเวลา ฉันจะ.."
            },
            "answer": {
                "id": 245,
                "question_id": 63,
                "choice_id": 1,
                "point": 1,
                "label": "นั่งรอเงียบ ๆ  ถ้าใครเข้ามาทัก ก็จะคุยด้วย ",
                "uid": "",
                "$$hashKey": "object:126"
            },
            "time": 1
        }, {
            "question": {
                "id": 61,
                "diff": 1,
                "category_id": 1,
                "question": "วันหยุดยาว ส่วนใหญ่ ฉันเลือกที่จะ..."
            },
            "answer": {
                "id": 242,
                "question_id": 61,
                "choice_id": 2,
                "point": 1,
                "label": "ดู Youtube ฟังเพลง อยู่กับบ้าน ",
                "uid": "5de9ae91-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:139"
            },
            "time": 1
        }, {
            "question": {
                "id": 66,
                "diff": 1,
                "category_id": 1,
                "question": "ฉันอยู่ในสถานที่ที่มีคนแน่นมาก ฉันจะ..."
            },
            "answer": {
                "id": 252,
                "question_id": 66,
                "choice_id": 2,
                "point": 1,
                "label": "รู้สึกอึดอัด ไม่สบายใจ อยากรีบออกไปให้เร็วที่สุด",
                "uid": "5deb66a2-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:151"
            },
            "time": 1
        }],
        "category_id": 1
    }, {
        "score": 1,
        "question": [{
            "question": {
                "id": 73,
                "diff": 1,
                "category_id": 2,
                "question": "เมื่อฉันประชุมงานกีฬาสี แล้วมีคนเสนอไอเดียใหม่ ๆ จำนวนมาก ฉันจะรู้สึกยังไง"
            },
            "answer": {
                "id": 265,
                "question_id": 73,
                "choice_id": 1,
                "point": 1,
                "label": "ก็ดีนะ มีความคิดใหม่ ๆ เข้ามา",
                "uid": "",
                "$$hashKey": "object:162"
            },
            "time": 1
        }, {
            "question": {
                "id": 71,
                "diff": 1,
                "category_id": 2,
                "question": "ถ้าต้องสอนเด็กประถมทำการบ้านเลข แต่ฉันลืมวิธีทำไปแล้ว ฉันจะ..."
            },
            "answer": {
                "id": 262,
                "question_id": 71,
                "choice_id": 2,
                "point": 1,
                "label": "อ่านเนื้อหาทฤษฎีให้เข้าใจก่อน แล้วสอน",
                "uid": "5deccbae-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:175"
            },
            "time": 1
        }, {
            "question": {
                "id": 70,
                "diff": 1,
                "category_id": 2,
                "question": "ฉันไม่เคยทำเค้กมาก่อน แต่อยากทำเค้กวันเกิดให้เพื่อนสนิท และมีงบไม่จำกัด ฉันจะ..."
            },
            "answer": {
                "id": 259,
                "question_id": 70,
                "choice_id": 1,
                "point": -1,
                "label": "เปิด Youtube ไป และทดลองทำตามไปด้วย เสียก็ทิ้ง ทำใหม่จนกระทั่งได้เค้กที่ต้องการ",
                "uid": "",
                "$$hashKey": "object:186"
            },
            "time": 1
        }, {
            "question": {
                "id": 72,
                "diff": 1,
                "category_id": 2,
                "question": "เมื่อฉันทำงานกีฬาสี ฉันจะ..."
            },
            "answer": {
                "id": 264,
                "question_id": 72,
                "choice_id": 2,
                "point": -1,
                "label": "เลือกงานที่ได้ลงมือทำ เช่น ตีกลอง ทำพู่ ทำ Cut-out ทำการแสดง พาเหรดต่าง ๆ",
                "uid": "5ded07e6-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:199"
            },
            "time": 1
        }, {
            "question": {
                "id": 69,
                "diff": 1,
                "category_id": 2,
                "question": "ฉันชอบการบ้านแบบไหนมากกว่ากัน"
            },
            "answer": {
                "id": 258,
                "question_id": 69,
                "choice_id": 2,
                "point": 1,
                "label": "การบ้านที่กำหนดเฉพาะหัวข้อ ให้อิสระในการทำเอาเอง",
                "uid": "5dec5249-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:211"
            },
            "time": 1
        }, {
            "question": {
                "id": 68,
                "diff": 1,
                "category_id": 2,
                "question": "ระหว่างเดินทางไปเรียน และมือถือแบตหมด ฉันมักจะ..."
            },
            "answer": {
                "id": 256,
                "question_id": 68,
                "choice_id": 2,
                "point": -1,
                "label": "มองออกไปนอกหน้าต่าง หรือสนใจผู้คนที่อยู่ในรถว่ากำลังทำอะไร สังเกตสิ่งต่าง ๆ ที่เกิดขึ้นรอบตัว",
                "uid": "5dec0e74-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:223"
            },
            "time": 1
        }, {
            "question": {
                "id": 74,
                "diff": 1,
                "category_id": 2,
                "question": "เมื่อดูหนังจบ ฉันมัก..."
            },
            "answer": {
                "id": 268,
                "question_id": 74,
                "choice_id": 2,
                "point": 1,
                "label": "วิเคราะห์ถึงสิ่งที่หนังต้องการสื่อ",
                "uid": "5ded7a34-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:235"
            },
            "time": 1
        }],
        "category_id": 2
    }, {
        "score": 1,
        "question": [{
            "question": {
                "id": 78,
                "diff": 1,
                "category_id": 3,
                "question": "เพื่อนของฉันกำลังเศร้ามาก ฉันจะ..."
            },
            "answer": {
                "id": 276,
                "question_id": 78,
                "choice_id": 2,
                "point": 1,
                "label": "ถามความรู้สึก ทำให้เพื่อนรู้สึกดี อย่างอื่นค่อยว่ากันทีหลัง",
                "uid": "5dee7991-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:247"
            },
            "time": 1
        }, {
            "question": {
                "id": 78,
                "diff": 1,
                "category_id": 3,
                "question": "เพื่อนของฉันกำลังเศร้ามาก ฉันจะ..."
            },
            "answer": {
                "id": 276,
                "question_id": 78,
                "choice_id": 2,
                "point": 1,
                "label": "ถามความรู้สึก ทำให้เพื่อนรู้สึกดี อย่างอื่นค่อยว่ากันทีหลัง",
                "uid": "5dee7991-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:247"
            },
            "time": 1
        }, {
            "question": {
                "id": 81,
                "diff": 1,
                "category_id": 3,
                "question": "ฉันให้ความสำคัญกับอะไรมากกว่ากัน"
            },
            "answer": {
                "id": 282,
                "question_id": 81,
                "choice_id": 2,
                "point": 1,
                "label": "ความรู้สึกของทุกคน",
                "uid": "5def3514-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:271"
            },
            "time": 1
        }, {
            "question": {
                "id": 80,
                "diff": 1,
                "category_id": 3,
                "question": "เมื่อต้อง Comment งานคนอื่น ฉันจะ..."
            },
            "answer": {
                "id": 280,
                "question_id": 80,
                "choice_id": 2,
                "point": -1,
                "label": "พูดตรง ๆ คิดยังไง ก็พูดอย่างงั้น",
                "uid": "5deefcd3-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:283"
            },
            "time": 1
        }, {
            "question": {
                "id": 79,
                "diff": 1,
                "category_id": 3,
                "question": "ฉันว่าการสื่อสารที่ดีควร..."
            },
            "answer": {
                "id": 278,
                "question_id": 79,
                "choice_id": 2,
                "point": -1,
                "label": "มีหลักการ ขั้นตอน และข้อมูลที่พิสูจน์ได้",
                "uid": "5deec09f-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:295"
            },
            "time": 1
        }, {
            "question": {
                "id": 79,
                "diff": 1,
                "category_id": 3,
                "question": "ฉันว่าการสื่อสารที่ดีควร..."
            },
            "answer": {
                "id": 278,
                "question_id": 79,
                "choice_id": 2,
                "point": -1,
                "label": "มีหลักการ ขั้นตอน และข้อมูลที่พิสูจน์ได้",
                "uid": "5deec09f-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:295"
            },
            "time": 1
        }, {
            "question": {
                "id": 75,
                "diff": 1,
                "category_id": 3,
                "question": "ฉันคิดว่าการเห็นแก่ตัว..."
            },
            "answer": {
                "id": 269,
                "question_id": 75,
                "choice_id": 1,
                "point": 1,
                "label": "เป็นพฤติกรรมที่ไม่เหมาะสม ไม่เป็นที่ยอมรับในสังคม",
                "uid": "",
                "$$hashKey": "object:318"
            },
            "time": 0
        }],
        "category_id": 3
    }, {
        "score": -1,
        "question": [{
            "question": {
                "id": 75,
                "diff": 1,
                "category_id": 3,
                "question": "ฉันคิดว่าการเห็นแก่ตัว..."
            },
            "answer": {
                "id": 270,
                "question_id": 75,
                "choice_id": 2,
                "point": -1,
                "label": "หากไม่ได้ละเมิดสิทธิใคร ก็ไม่ควรตำหนิ",
                "uid": "5dedb240-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:319"
            },
            "time": 1
        }, {
            "question": {
                "id": 87,
                "diff": 1,
                "category_id": 4,
                "question": "เวลาฉันไปเที่ยวต่างจังหวัด ฉันวางแผนยังไง"
            },
            "answer": {
                "id": 293,
                "question_id": 87,
                "choice_id": 1,
                "point": 1,
                "label": "ก็วางแผนคร่าว ๆ  เผื่อเวลาให้กับสิ่งไม่คาดคิดบ้าง",
                "uid": "",
                "$$hashKey": "object:330"
            },
            "time": 0
        }, {
            "question": {
                "id": 82,
                "diff": 1,
                "category_id": 4,
                "question": "ก่อนออกจากบ้าน ฉันวางแผนแค่ไหน"
            },
            "answer": {
                "id": 283,
                "question_id": 82,
                "choice_id": 1,
                "point": -1,
                "label": "วางแผนละเอียด ว่าต้องทำอะไร ที่ไหน กับใคร",
                "uid": "",
                "$$hashKey": "object:354"
            },
            "time": 0
        }, {
            "question": {
                "id": 86,
                "diff": 1,
                "category_id": 4,
                "question": "ฉันคิดว่าคนแบบไหนใช้ชีวิตลำบากกว่ากัน"
            },
            "answer": {
                "id": 291,
                "question_id": 86,
                "choice_id": 1,
                "point": -1,
                "label": "คนที่ไม่มีระเบียบในการใช้ชีวิต",
                "uid": "",
                "$$hashKey": "object:366"
            },
            "time": 0
        }, {
            "question": {
                "id": 85,
                "diff": 1,
                "category_id": 4,
                "question": "ถ้าฉันรู้สึกว่างานจะเสร็จไม่ทัน ฉันจะ..."
            },
            "answer": {
                "id": 290,
                "question_id": 85,
                "choice_id": 2,
                "point": -1,
                "label": "เร่งทำให้ทันให้ได้",
                "uid": "5df023a6-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:379"
            },
            "time": 1
        }, {
            "question": {
                "id": 83,
                "diff": 1,
                "category_id": 4,
                "question": "ถ้าเพื่อนขอเลื่อนนัดกระทันหัน ถึงฉันจะว่าง ฉัน..."
            },
            "answer": {
                "id": 285,
                "question_id": 83,
                "choice_id": 1,
                "point": 1,
                "label": "ได้หมด ถ้าฉันว่าง ยังไงก็ได้",
                "uid": "",
                "$$hashKey": "object:390"
            },
            "time": 0
        }, {
            "question": {
                "id": 88,
                "diff": 1,
                "category_id": 4,
                "question": "ถ้าต้องส่งการบ้านพรุ่งนี้ แต่ฉันง่วงมากแล้ว ฉันจะ..."
            },
            "answer": {
                "id": 296,
                "question_id": 88,
                "choice_id": 2,
                "point": 1,
                "label": "ไปนอนเลย ค่อยหาทางออกพรุ่งนี้",
                "uid": "5df0dfe2-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:403"
            },
            "time": 2
        }],
        "category_id": 4
    }, {
        "score": -1,
        "question": [{
            "question": {
                "id": 91,
                "diff": 1,
                "category_id": 5,
                "question": "ฉันจัดห้องหรือโต๊ะของฉันยังไง"
            },
            "answer": {
                "id": 302,
                "question_id": 91,
                "choice_id": 2,
                "point": -1,
                "label": "ฉันไม่จุกจิก แค่หยิบของใช้ได้ก็พอ",
                "uid": "5df19e3c-6789-11e7-94fd-b888e3621708",
                "$$hashKey": "object:415"
            },
            "time": 1
        }, {
            "question": {
                "id": 93,
                "diff": 1,
                "category_id": 5,
                "question": "ฉันชอบชีวิตที่..."
            },
            "answer": {
                "id": 305,
                "question_id": 93,
                "choice_id": 1,
                "point": -1,
                "label": "ไม่เร่งรีบ อยู่กับปัจจุบัน เป็นหลัก",
                "uid": "",
                "$$hashKey": "object:426"
            },
            "time": 0
        }, {
            "question": {
                "id": 95,
                "diff": 1,
                "category_id": 5,
                "question": "ฉันทำแบบสอบถามมาใกล้จบละ จะรู้ผลลัพธ์แล้ว...รู้สึยังไงมั่ง"
            },
            "answer": {
                "id": 309,
                "question_id": 95,
                "choice_id": 1,
                "point": 1,
                "label": "ไม่ค่อยแน่ใจคำตอบบางข้อเลย อยากกลับไปแก้จัง",
                "uid": "",
                "$$hashKey": "object:438"
            },
            "time": 0
        }, {
            "question": {
                "id": 94,
                "diff": 1,
                "category_id": 5,
                "question": "หากมีคนพูดถึงฉัน แต่ไม่รู้ว่าพูดถึงยังไง...ฉันจะรู้สึก..."
            },
            "answer": {
                "id": 307,
                "question_id": 94,
                "choice_id": 1,
                "point": 1,
                "label": "กังวล อยากรู้ว่าเค้าพูดถึงฉันยังไงมั่ง",
                "uid": "",
                "$$hashKey": "object:450"
            },
            "time": 0
        }, {
            "question": {
                "id": 90,
                "diff": 1,
                "category_id": 5,
                "question": "ข้อใดเป็นตัวฉันมากกว่ากัน..."
            },
            "answer": {
                "id": 299,
                "question_id": 90,
                "choice_id": 1,
                "point": -1,
                "label": "ฉันพอใจกับสิ่งที่เป็น ไม่กังวลถึงอนาคตมาก",
                "uid": "",
                "$$hashKey": "object:462"
            },
            "time": 0
        }, {
            "question": {
                "id": 92,
                "diff": 1,
                "category_id": 5,
                "question": "ฉันได้รับไฟล์งานมาจากเพื่อน ซึ่ง Format ไม่สวยเลย แต่จริง ๆ ก็ใช้งานได้ ฉันจะ..."
            },
            "answer": {
                "id": 303,
                "question_id": 92,
                "choice_id": 1,
                "point": -1,
                "label": "ใช้ไฟล์ตามปกติ ไม่แก้อะไร",
                "uid": "",
                "$$hashKey": "object:474"
            },
            "time": 1
        }, {
            "question": {
                "id": 89,
                "diff": 1,
                "category_id": 5,
                "question": "เมื่อฉันผิดหวัง หรือทำบางอย่างไม่สำเร็จ"
            },
            "answer": {
                "id": 297,
                "question_id": 89,
                "choice_id": 1,
                "point": 1,
                "label": "ฉันไม่ปล่อยวาง จะทำจนกว่าจะสำเร็จ",
                "uid": "",
                "$$hashKey": "object:486"
            },
            "time": 0
        }],
        "category_id": 5
    }]}';
$data = json_decode($json);
echo $data->current_category_competency;
