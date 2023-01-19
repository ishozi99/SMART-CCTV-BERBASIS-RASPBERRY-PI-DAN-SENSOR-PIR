import atexit
procs = []
def kill_subprocesses():
  for proc in procs:
    proc.kill()
 
atexit.register(kill_subprocesses)
