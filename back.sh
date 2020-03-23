#!/bin/sh
file_name=cs302.mysql
current_time=$(date "+%Y.%m.%d-%H.%M.%S")
new_fileName=$file_name.$current_time

mysqldump -u ubuntu -ppassword cs302 > /home/ubuntu/$new_fileName

