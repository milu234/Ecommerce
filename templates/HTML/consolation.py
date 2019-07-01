def numofPrizes(k, marks):
    a={}
    rank=1
    marks = list(filter(lambda b: b != 0, marks))
    for num in sorted(marks, reverse = True):
        if num not in a:
            a[num]=rank
            rank=rank+1
    ranks = [a[i] for i in sorted(marks, reverse = True)]
    finalKey = -1
    for key,val in a.items():
        if val == k:
            finalKey = key
    count = 0
    for x in marks:
        if x>= finalKey:
            count+=1    
    return count