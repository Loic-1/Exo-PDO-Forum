-- used in isUniquePseudo
SELECT *
FROM user u
WHERE u.nickName = "ted"; -- current $pseudo

-- used in isUniqueMail
SELECT *
FROM user u
WHERE u.email = "loic.vasile@test.fr"; -- current $mail

-- used in findPasswordByMail
SELECT u.password
FROM user u
WHERE u.email = "jeff@test.fr"; -- current $mail